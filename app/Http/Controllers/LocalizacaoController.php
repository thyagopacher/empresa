<?php

namespace App\Http\Controllers;

use App\Localizacao;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class LocalizacaoController extends Controller {
 
    public function salvar_rota_app() {
        $localizacao = new Localizacao();
        $localizacao->longitude  = Input::get("longitude");
        $localizacao->latitude   = Input::get("latitude");
        $localizacao->enderecoip = Input::get("enderecoip");
        $localizacao->codcliente = Input::get("codcliente");
        $resSave = $localizacao->save();
        if($resSave == FALSE){
            die(json_encode(array('mensagem' => 'Erro ao salvar sua rota !!!', 'situacao' => false)));
        }else{
            die(json_encode(array('mensagem' => '', 'situacao' => true)));
        }
    }
}
    