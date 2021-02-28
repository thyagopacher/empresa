@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Fornecedor</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="inserir_fornecedor">
                        <fieldset>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="nome">Razão:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="razao" id="razao" required placeholder="Razão social do fornecedor">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">E-mail:</label>
                                <div class="col-sm-10">          
                                    <input type="email" class="form-control" name="email" id="email" required placeholder="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="confirmeemail">Confirme E-mail:</label>
                                <div class="col-sm-10">          
                                    <input type="email" class="form-control" name="confirmeemail" id="confirmeemail" required placeholder="confirme email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="senha">Senha:</label>
                                <div class="col-sm-10">          
                                    <input type="password" class="form-control" name="senha" id="senha" required placeholder="senha">
                                </div>
                            </div>
 
                            <div class="form-group">        
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Salvar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
