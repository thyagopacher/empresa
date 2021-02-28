<?php

namespace App\Http\Controllers;

use App\User;
use App\Cliente;
use App\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index() {

        $cliente = (array) DB::table('clientes')->where('email', Session::get('email'))->get();
        if (!isset($cliente[0]) || $cliente[0] == NULL) {
            $fornecedor = (array) DB::table('fornecedors')->where('email', Session::get('email'))->get();
            if (isset($fornecedor[0]) && $fornecedor[0] != NULL) {
                $fornecedor = (array) $fornecedor[0];
                Session::put('codstatus', $fornecedor["codstatus"]);
                return view('home')->with('objeto', $fornecedor);
            }
        } else {
            $cliente = (array) $cliente[0];
            Session::put('codstatus', $cliente["codstatus"]);
            return view('home')->with('objeto', $cliente);
        }
    }

    public function reenvio_token() {
        $cliente = (array) DB::table('clientes')->where('email', Session::get('email'))->get();
        $cliente = (array) $cliente[0];

        Mail::send('email.reenviaToken', array('tokenCliente' => $cliente["token"]), function ($message)use ($cliente) {
            $message->to($cliente["email"], $cliente["nome"]);
            $message->subject('Reenvio de token');
        });
        die(json_encode(array('mensagem' => 'Um e-mail de com a nova senha será enviado!', 'enviosenha' => true, 'situacao' => true, 'email' => $cliente["email"])));
    }

    public function recuperarSenha(Request $request) {
        $cliente = (array) DB::table('clientes')->where('email', $request->input("email"))->get();
        if (isset($cliente[0]) && $cliente[0] != NULL) {
            if ($request->input("envia_email") == "s") {
                $cliente = (array) $cliente[0];
                $codCliente = $cliente["codcliente"];
                $senhaEmail = $this->geraSenha();
                $cliente = Cliente::findOrFail($codCliente);
                $cliente->codcliente = $codCliente;
                $cliente->senha = Hash::make($senhaEmail);
                $cliente->update();

                $users = (array) DB::table('users')->where('codperfil', $cliente["codcliente"])->get();
                $users = (array) $users[0];

                $codUser = $users["id"];
                $users = User::findOrFail($codUser);
                $users->id = $codUser;
                $users->password = $cliente->senha;
                $users->save();

                Mail::send('email.renviaSenha', array('senha' => $senhaEmail), function ($message)use ($cliente) {
                    $message->to($cliente["email"], $cliente["nome"]);
                    $message->subject('Recuperação de senha');
                });
                die(json_encode(array('mensagem' => 'Um e-mail de com a nova senha será enviado!', 'enviosenha' => true, 'situacao' => true, 'email' => $cliente["email"])));
            } else {
                $cliente = (array) $cliente[0];
                die(json_encode(array('email' => $cliente["email"], 'situacao' => true)));
            }
        } else {
            die(json_encode(array('mensagem' => 'Não localizou', 'situacao' => true)));
        }
    }

    public function perfil(Request $request) {
        $cliente = (array) DB::table('clientes')->where('email', Session::get('email'))->get();
        if (!isset($cliente[0]) || $cliente[0] == NULL) {
            $fornecedor = (array) DB::table('fornecedors')->where('email', $request->session()->get('email'))->get();
            if (isset($fornecedor[0]) && $fornecedor[0] != NULL) {
                return view('fornecedor/perfil')->with('fornecedor', (array) $fornecedor[0]);
            }
        } else {
            return view('cliente/perfil')->with('cliente', (array) $cliente[0]);
        }
    }

    public function ativar(Request $request) {
        $cliente = (array) DB::table('clientes')->where('email', $request->session()->get('email'))->get();
        if (!isset($cliente[0]) || $cliente[0] == NULL) {
            if (session('email') == NULL || session('email') == "") {
                return view('erro')->with('message', 'E-mail da sessão esta em branco tente se logar novamente!!!');
            }
            $fornecedor = (array) DB::table('fornecedors')->where('email', session('email'))->get();
            $fornecedor = $fornecedor[0];
            $codigoFornecedor = $fornecedor["codfornecedor"];

            if ($fornecedor["token"] != $request->input("tokenAtivacao") && $fornecedor["codstatus"] == "1") {
                return view('erro')->with('message', 'Token digitado é diferente do cadastrado!!!');
            } elseif ($fornecedor["token"] != $request->input("tokenAtivacao") && $fornecedor["codstatus"] == "2") {
                return view('erro')->with('message', 'Token ja esta ativado!!!');
            }

            $fornecedor = Fornecedor::findOrFail($codigoFornecedor);
            $fornecedor->codfornecedor = $codigoFornecedor;
            $fornecedor->codstatus = '2';
            Session::put('codstatus', '2');
            $fornecedor->update();
            return view('sucesso')->with('mensagem', 'Ativado com sucesso!!!');
        } else {
            $cliente = (array) $cliente[0];
            $codigoCliente = $cliente["codcliente"];

            if ($cliente["token"] != $request->input("tokenAtivacao") && $cliente["codstatus"] == "0") {
                die(json_encode(array('mensagem' => 'Token digitado é diferente do cadastrado!!!', 'situacao' => false)));
            } elseif ($cliente["codstatus"] == "2") {
                $request->session()->flash('codstatus', '2');               
                die(json_encode(array('mensagem' => 'Token já está ativado!!!', 'situacao' => false)));
            }

            $cliente = Cliente::findOrFail($codigoCliente);
            $cliente->codcliente = $codigoCliente;
            $cliente->codstatus = 2;
            $request->session()->flash('codstatus', '2');
            $cliente->update();
            die(json_encode(array('mensagem' => 'Perfil ativado com sucesso!!!', 'situacao' => true)));
        }
    }

    public function upload_capa(Request $request) {
        $cliente = (array) DB::table('clientes')->where('email', $request->session()->get('email'))->get();
        $capa = Input::file('capa');
        if ($capa) {
            $nomeArquivo = 'capa_' . date("YmdHisu") . '.png';
            $capa->move('img', $nomeArquivo);
        } else {
            return view('erro')->with('message', 'Erro ao enviar capa!!!');
        }

        if (!isset($cliente[0]) || $cliente[0] == NULL) {
            if (session('email') == NULL || session('email') == "") {
                return view('erro')->with('message', 'E-mail da sessão esta em branco tente se logar novamente!!!');
            }
            $fornecedor = (array) DB::table('fornecedors')->where('email', session('email'))->get();
            $fornecedor = (array) $fornecedor[0];
            $codigoFornecedor = $fornecedor["codfornecedor"];

            $fornecedor = Fornecedor::findOrFail($codigoFornecedor);
            $fornecedor->codfornecedor = $codigoFornecedor;
            $fornecedor->capa = $nomeArquivo;
            $fornecedor->update();
        } else {
            $cliente = (array) $cliente[0];
            $codigoCliente = $cliente["codcliente"];

            $cliente = Cliente::findOrFail($codigoCliente);
            $cliente->codcliente = $codigoCliente;
            $cliente->capa = $nomeArquivo;
            $cliente->update();
        }
        $this->index();
    }

    public function upload_foto(Request $request) {
        $cliente = (array) DB::table('clientes')->where('email', $request->session()->get('email'))->get();
        $imagem = Input::file('imagem');
        if ($imagem) {
            $nomeArquivo = 'imagem_' . date("YmdHisu") . '.png';
            $imagem->move('img', $nomeArquivo);
        } else {
            return view('erro')->with('message', 'Erro ao enviar imagem!!!');
        }

        if (!isset($cliente[0]) || $cliente[0] == NULL) {
            if (session('email') == NULL || session('email') == "") {
                return view('erro')->with('message', 'E-mail da sessão esta em branco tente se logar novamente!!!');
            }
            $fornecedor = (array) DB::table('fornecedors')->where('email', session('email'))->get();
            $fornecedor = (array) $fornecedor[0];
            $codigoFornecedor = $fornecedor["codfornecedor"];

            $fornecedor = Fornecedor::findOrFail($codigoFornecedor);
            $fornecedor->codfornecedor = $codigoFornecedor;
            $fornecedor->imagem = $nomeArquivo;
            $fornecedor->update();
        } else {
            $cliente = (array) $cliente[0];
            $codigoCliente = $cliente["codcliente"];

            $cliente = Cliente::findOrFail($codigoCliente);
            $cliente->codcliente = $codigoCliente;
            $cliente->imagem = $nomeArquivo;
            $cliente->update();
        }
        $this->index();
    }

    public function cortar_capa(Request $request) {
        $targ_w = $targ_h = 150;
        $jpeg_quality = 90;

        $cliente = (array) DB::table('clientes')->where('email', $request->session()->get('email'))->get();
        if (!isset($cliente[0]) || $cliente[0] == NULL) {
            $fornecedorArray = (array) DB::table('fornecedors')->where('email', session('email'))->get();
            $fornecedorArray = (array) $fornecedorArray[0];
            $codigoFornecedor = $fornecedorArray["codfornecedor"];

            $fornecedor = Fornecedor::findOrFail($codigoFornecedor);
            $fornecedor->codfornecedor = $codigoFornecedor;
            $fornecedor->xcapa = $request->input("x");
            $fornecedor->ycapa = $request->input("y");
            $fornecedor->wcapa = $request->input("w");
            $fornecedor->hcapa = $request->input("h");
            $fornecedor->update();
            return view('home')->with('objeto', $fornecedorArray);
        } else {
            $clienteArray = (array) $cliente[0];
            $codigoCliente = $clienteArray["codcliente"];

            $cliente = Cliente::findOrFail($codigoCliente);
            $cliente->codcliente = $codigoCliente;
            $cliente->xcapa = $request->input("x");
            $cliente->ycapa = $request->input("y");
            $cliente->wcapa = $request->input("w");
            $cliente->hcapa = $request->input("h");
            $cliente->update();
            return view('home')->with('objeto', $clienteArray);
        }
    }

    public function mostraCapa() {
        $cliente = (array) DB::table('clientes')->where('email', session('email'))->get();
        if (!isset($cliente[0]) || $cliente[0] == NULL) {
            $fornecedor = (array) DB::table('fornecedors')->where('email', session('email'))->get();
            $fornecedor = (array) $fornecedor[0];
            $src = $fornecedor["capa"];
            $xcapa = $fornecedor["xcapa"];
            $ycapa = $fornecedor["ycapa"];
            $wcapa = $fornecedor["wcapa"];
            $hcapa = $fornecedor["hcapa"];
        } else {
            $cliente = (array) $cliente[0];
            $src = $cliente["capa"];
            $xcapa = $cliente["xcapa"];
            $ycapa = $cliente["ycapa"];
            $wcapa = $cliente["wcapa"];
            $hcapa = $cliente["hcapa"];
        }
        if ($src == "" || !file_exists('./img/' . $src)) {
            $src = 'sem_imagem.png';
            return file_get_contents('./img/' . $src);
        }
        if ($wcapa == 0 || $hcapa == 0) {
            $wcapa = 940;
            $hcapa = 370;
        }

        $targ_w = $targ_h = 150;
        $jpeg_quality = 90;

        $img_r = imagecreatefromjpeg('./img/' . $src);
        $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

        imagecopyresampled($dst_r, $img_r, 0, 0, $xcapa, $ycapa, $targ_w, $targ_h, $wcapa, $hcapa);

        header('Content-type: image/jpeg');
        imagejpeg($dst_r, null, $jpeg_quality);

        exit;
    }

    public function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin;
        if ($maiusculas)
            $caracteres .= $lmai;
        if ($numeros)
            $caracteres .= $num;
        if ($simbolos)
            $caracteres .= $simb;
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }
        return $retorno;
    }

}
