@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Perfil</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="atualizar_fornecedor">
                        <input type="hidden" name="codfornecedor" id="codfornecedor" value="<?=$fornecedor["codfornecedor"]?>"/>
                        <legend>Informações básicas da empresa</legend>
                        <fieldset>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="nome">Fantasia:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fantasia" id="fantasia" required placeholder="Nome fantasia do fornecedor" value="<?=$fornecedor["razao"]?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="nome">Razão:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="razao" id="razao" required placeholder="Razão social do fornecedor" value="<?=$fornecedor["razao"]?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="nome">Tipo:</label>
                                <div class="col-sm-4">
                                    <select name="tipo" id="tipo" class="form-control">
                                        <option value="">--Selecione--</option>
                                        <option <?php if($fornecedor["tipo"] == "Matriz"){echo "selected";}?>>Matriz</option>
                                        <option <?php if($fornecedor["tipo"] == "Filial"){echo "selected";}?>>Filial</option>
                                    </select>
                                </div>
                                <label style="<?php if($fornecedor["tipo"] == ""){echo "display: none";}?>" class="control-label col-sm-2 abacode" for="nome">ABACODE:</label>
                                <div style="<?php if($fornecedor["tipo"] == ""){echo "display: none";}?>" class="col-sm-4 abacode">
                                    <input type="text" <?php if($fornecedor["tipo"] == "Matriz"){echo "disabled";}?> class="form-control" name="abacode" id="abacode" value="<?=$fornecedor["abacode"]?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Dt. Fundação:</label>
                                <div class="col-sm-10">          
                                    <input type="date" class="form-control" max="<?=date("Y-m-d")?>" name="dtfundacao" id="dtfundacao" value="<?=$fornecedor["dtfundacao"]?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Dt. Inauguração:</label>
                                <div class="col-sm-10">          
                                    <input type="date" class="form-control" max="<?=date("Y-m-d")?>" name="dtinauguracao" id="dtinauguracao" value="<?=$fornecedor["dtinauguracao"]?>">
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
