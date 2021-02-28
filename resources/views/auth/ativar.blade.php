@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Perfil</div>

                <div class="panel-body">
                    @if(Session::get("codstatus") == 0)
                    <form method="post" id="fenvio" action="/ativar">
                        <legend>Ativar seu token</legend>
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <fieldset>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="nome">Token:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="tokenAtivacao" id="tokenAtivacao"  class="form-control" placeholder="Digite código de ativação"/>
                                </div>
                            </div>  
                            <div class="form-group">  
                                <div class="col-sm-offset-2 col-sm-10">
                                    <br>
                                    <input type="button" id="enviarToken" name="enviarToken" class="btn btn-default" value="Enviar"/>
                                </div>   
                            </div>
                        </fieldset>
                    </form> 
                    @else
                    <form id="freenvio">
                         <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <input type="button" name="reenvioToken" id="reenvioToken" class="btn btn-default" value="Reenviar token"/>
                        </div>
                    </form> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
