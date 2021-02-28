<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class FornecedorController extends Controller {

    public function lista() {
        return view('fornecedor.lista');
    }

    public function cadastro() {
        return view('fornecedor.cadastro');
    }

    public function perfil() {
        return view('fornecedor.perfil');
    }

    public function inserir(Request $request) {
        
        /**validação de e-mail para quando estiver inserindo clientes*/
        $resValidacao = $this->validaemail($request->input("email"));
        if($resValidacao["situacao"] == false){
            return view('erro')->with('message', $resValidacao["mensagem"]);
        }
        
        $fornecedor = (array)DB::table('fornecedors')->where('email', $request->input("email"))->get();
        if(isset($fornecedor[0]) && $fornecedor[0] != NULL){
            $fornecedor = (array)$fornecedor[0];
        }        
        if(isset($fornecedor["codfornecedor"]) && $fornecedor["codfornecedor"] != NULL && $fornecedor["codfornecedor"] != ""){
            return view('jacadastrado');
        }else{
            $fornecedor = new Fornecedor();
            $fornecedor->razao   = $request->input("razao");
            $fornecedor->email   = $request->input("email");
            $fornecedor->tipo    = '';
            $fornecedor->senha   = Hash::make($request->input("senha"));
            $fornecedor->token   = $this->uniqueAlfa(6);
            $fornecedor->abacode = $this->uniqueAlfa(6);
            $tokenCliente = $fornecedor->token;            
            $fornecedor->save();
            $fornecedor = (array)DB::table('fornecedors')->where('email', $request->input("email"))->get()[0];
        }  
        $user = new User();
        $user->name = $request->input("razao");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("senha"));
        $user->codperfil = $fornecedor["codfornecedor"];
        $user->save();
        
        Mail::send('email.enviaToken', array('tokenCliente' => $tokenCliente),  function ($message)use ($user) {
            $message->to($user->email, $user->name);
            $message->subject('Confirmação de inscrição');
        });
        
        return view('sucesso')->with('mensagem', 'Cadastrado realizado com sucesso! Acesse ja a sua conta e ative-a por meio do token que foi enviado para a conta de e-mail cadastrada aqui');
    }

    public function atualizar(Request $request) {
        $fornecedor = Fornecedor::findOrFail($request->input("codfornecedor"));
        if($request->input("tipo") == "Filial"){
            $matriz = (array)DB::table('fornecedors')->where('abacode', $request->input("abacode"))->get();
            if (isset($matriz[0]) && $matriz[0] != NULL) {
                $fornecedor->abacode = $request->input("abacode");
            }else{
                return view('erro')->with('message', 'ABACODE inválido!!!');
            }
        }
        $fornecedor->razao = $request->input("razao");
        $fornecedor->fantasia = $request->input("fantasia");
        $fornecedor->dtfundacao = $request->input("dtfundacao");
        $fornecedor->tipo = $request->input("tipo");
        $fornecedor->dtinauguracao = $request->input("dtinauguracao");
        $fornecedor->update();
        return view('sucesso')->with('mensagem', 'Perfil atualizado com sucesso!!!');
    }

    public function ativar(Request $request) {
        $fornecedor = (array)DB::table('fornecedors')->where('email', $request->session()->get('email'))->get()[0];
        $codigoFornecedor = $fornecedor["codfornecedor"];
        
        if($fornecedor["token"] != $request->input("tokenAtivacao") && $fornecedor["ativado"] == "n"){
            return view('erro')->with('message', 'Token digitado é diferente do cadastrado!!!');
        }elseif($fornecedor["token"] != $request->input("tokenAtivacao") && $fornecedor["ativado"] == "s"){
            return view('erro')->with('message', 'Token ja esta ativado!!!');
        }        
        
        $fornecedor = Fornecedor::findOrFail($codigoFornecedor);
        $fornecedor->codfornecedor = $codigoFornecedor;
        $fornecedor->codstatus = '10';
        $fornecedor->update();
        return view('sucesso')->with('mensagem', 'Ativado com sucesso!!!');
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
        //verifica se e-mail esta no formato correto de escrita
        if (!ereg('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})', $email)) {
            $retorno = array('mensagem' => "E-mail inválido", 'situacao' => false);
        } else {
            //Valida o dominio
            $dominio = explode('@', $email);
            if (!checkdnsrr($dominio[1], 'A')) {
                $retorno = array('mensagem' => "Dominio de e-mail inválido!", 'situacao' => false);
            } else {
                $retorno = array('mensagem' => "", 'situacao' => true);
            } // Retorno true para indicar que o e-mail é valido
        }
        return $retorno;
    }
}
