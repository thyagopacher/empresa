<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClienteController extends Controller {

    public function lista() {
        return view('cliente.lista');
    }

    public function cadastro() {
        return view('cliente.cadastro');
    }

    public function perfil() {
        return view('cliente.perfil');
    }

    public function inserir(Request $request) {
        if ($request->input("nome") == NULL || $request->input("nome") == "") {
            die(json_encode(array('mensagem' => 'Não pode cadastrar sem nome!!!', 'situacao' => false)));
        }
        if ($request->input("sobrenome") == NULL || $request->input("sobrenome") == "") {
            die(json_encode(array('mensagem' => 'Não pode cadastrar sem sobrenome!!!', 'situacao' => false)));
        }
        if ($request->input("email") == NULL || $request->input("email") == "") {
            die(json_encode(array('mensagem' => 'Não pode cadastrar sem e-mail!!!', 'situacao' => false)));
        }
        if ($request->input("confirmeemail") == NULL || $request->input("confirmeemail") == "") {
            die(json_encode(array('mensagem' => 'Por favor confirme seu e-mail!!!', 'situacao' => false)));
        }
        if ($request->input("senha") == NULL || $request->input("senha") == "") {
            die(json_encode(array('mensagem' => 'Por favor insira uma senha!!!', 'situacao' => false)));
        }
        if ($request->input("sexo") == NULL || $request->input("sexo") == "") {
            die(json_encode(array('mensagem' => 'Não pode cadastrar sem sexo!!!', 'situacao' => false)));
        }
        if ($request->input("dtnascimento") == NULL || $request->input("dtnascimento") == "") {
            die(json_encode(array('mensagem' => 'Por favor insira a data de nascimento!!!', 'situacao' => false)));
        }

        /*         * validação de e-mail para quando estiver inserindo clientes */
        $resValidacao = $this->validaemail($request->input("email"));
        if ($resValidacao["situacao"] == false) {
            die(json_encode(array('mensagem' => $resValidacao["mensagem"], 'situacao' => false)));
        }

        $cliente = (array) DB::table('clientes')->where('email', $request->input("email"))->get();
        if (isset($cliente[0]) && $cliente[0] != NULL) {
            $cliente = (array) $cliente[0];
        }
        if (isset($cliente["codcliente"]) && $cliente["codcliente"] != NULL && $cliente["codcliente"] != "") {
            die(json_encode(array('mensagem' => 'jacadastrado', 'situacao' => false)));
        } else {
            $cliente = new Cliente();
            $cliente->nome = $request->input("nome");
            $cliente->sobrenome = $request->input("sobrenome");
            $cliente->email = $request->input("email");
            $emailCliente = $cliente->email;
            $cliente->senha = Hash::make($request->input("senha"));
            
            $cliente->sexo = $request->input("sexo");
            $cliente->token = $this->uniqueAlfa(6);
            $tokenCliente = $cliente->token;
            $cliente->save();
            $cliente = (array) DB::table('clientes')->where('email', $request->input("email"))->get()[0];
        }
        $user = new User();
        $user->name = $request->input("nome");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("senha"));
        $user->codperfil = $cliente["codcliente"];
        $user->psw2 = md5($request->input("senha"));
        $user->save();

        Mail::send('email.enviaToken', array('tokenCliente' => $tokenCliente), function ($message)use ($user) {
            $message->to($user->email, $user->name);
            $message->subject('Confirmação de inscrição');
        });
        die(json_encode(array('mensagem' => 'Cadastrado realizado com sucesso! Acesse ja a sua conta e ative-a por meio do token que foi enviado para a conta de e-mail cadastrada aqui', 'situacao' => true)));
    }

    public function atualizar(Request $request) {
        $cliente = Cliente::findOrFail($request->input("codcliente"));
        $cliente->nome = $request->input("nome");
        $cliente->sobrenome = $request->input("sobrenome");
        $cliente->sexo = $request->input("sexo");
        $cliente->dtnascimento = $request->input("dtnascimento");
        $cliente->escolaridade = $request->input("escolaridade");
        if ($request->input("senha") != NULL && $request->input("senha") != "") {
            $cliente->senha = Hash::make($request->input("senha"));
        }
        if ($request->input("codstatus") != NULL && $request->input("codstatus") != "") {
            $cliente->codstatus = $request->input("codstatus");
        }
        $cliente->update();

        if ($request->input("senha") != NULL && $request->input("senha") != "") {
            $user = (array) DB::table('users')->where('codperfil', $request->input("codcliente"))->get()[0];
            $user = User::findOrFail($user["codperfil"]);
            $user->password = Hash::make($request->input("senha"));
            $user->save();

            Mail::send('email.enviaSenha', array('senhaCliente' => $request->input("senha")), function ($message)use ($user) {
                $message->to($user->email, $user->name);
                $message->subject('Troca de senha');
            });
        }

        return view('sucesso')->with('mensagem', 'Perfil atualizado com sucesso!!!');
    }

    public function ativar(Request $request) {
        $cliente = (array) DB::table('clientes')->where('email', $request->session()->get('email'))->get()[0];
        $codigoCliente = $cliente["codcliente"];

        if ($cliente["token"] != $request->input("tokenAtivacao") && $cliente["ativado"] == "n") {
            die(json_enode(array('mensagem' => 'Tokem digitado é diferente do cadastrado!!!', 'situacao' => false)));
        } elseif ($cliente["token"] != $request->input("tokenAtivacao") && $cliente["ativado"] == "s") {
            die(json_encode(array('mensagem' => 'Token já está ativado!!!', 'situacao' => false)));
        }

        $cliente = Cliente::findOrFail($codigoCliente);
        $cliente->codcliente = $codigoCliente;
        $cliente->codstatus = '10';
        $cliente->update();
        die(json_encode(array('mensagem' => 'Perfil ativado com sucesso!!!', 'situacao' => true)));
    }

    public function excluirCapa(Request $request) {
        $cliente = (array) DB::table('clientes')->where('email', $request->session()->get('email'))->get()[0];
        $codigoCliente = $cliente["codcliente"];

        $cliente = Cliente::findOrFail($codigoCliente);
        $cliente->codcliente = $codigoCliente;
        $cliente->capa = '';
        $cliente->update();
        return view('sucesso')->with('mensagem', 'Capa excluida!!!');
    }

    public function excluirImagem(Request $request) {
        $cliente = (array) DB::table('clientes')->where('email', $request->session()->get('email'))->get()[0];
        $codigoCliente = $cliente["codcliente"];

        $cliente = Cliente::findOrFail($codigoCliente);
        $cliente->codcliente = $codigoCliente;
        $cliente->imagem = '';
        $cliente->update();
        return view('sucesso')->with('mensagem', 'Imagem foto excluida!!!');
    }

    function uniqueAlfa($length = 16) {
        $salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $len = strlen($salt);
        $pass = '';
        mt_srand(10000000 * (double) microtime());
        for ($i = 0; $i < $length; $i++) {
            $pass .= $salt[mt_rand(0, $len - 1)];
        }
        return $pass;
    }

    /**
     * validação de e-mail completa
     * @param string $email passa o e-mail para validação
     * @return array retorno string com mensagem de validação e boolean com verificador
     */
    public function validaemail($email) {
        $retorno = null;
        //Valida o dominio
        $dominio = explode('@', $email);
        if (!checkdnsrr($dominio[1], 'A')) {
            $retorno = array('mensagem' => "Dominio de e-mail inválido!", 'situacao' => false);
        } else {
            $retorno = array('mensagem' => "", 'situacao' => true);
        } // Retorno true para indicar que o e-mail é valido
        return $retorno;
    }

}
