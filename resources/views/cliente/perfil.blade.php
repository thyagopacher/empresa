@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">      
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Perfil</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="atualizar_cliente">
                        <legend>Informações básicas sobre você</legend>
                        <input type="hidden" name="codcliente" id="codcliente" value="<?=$cliente["codcliente"]?>"/>
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <fieldset>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="nome">Nome:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nome" id="nome" required title="nome do cliente" placeholder="nome" value="<?=$cliente["nome"]?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="sobrenome">Sobrenome:</label>
                                <div class="col-sm-10">          
                                    <input type="text" class="form-control" name="sobrenome" id="sobrenome" required title="sobrenome do cliente" placeholder="sobrenome" value="<?=$cliente["sobrenome"]?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="sexo">Gênero:</label>
                                <div class="col-sm-10">          
                                    <select name="sexo" id="sexo" class="form-control">
                                        <option value="">--Selecione--</option>
                                        <option value="m" <?php if(isset($cliente["sexo"]) && $cliente["sexo"] == "m"){echo "selected";}?>>Masculino</option>
                                        <option value="f" <?php if(isset($cliente["sexo"]) && $cliente["sexo"] == "f"){echo "selected";}?>>Feminino</option>
                                    </select>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Dt. Nascimento:</label>
                                <div class="col-sm-10">          
                                    <input type="date" class="form-control" name="dtnascimento" id="dtnascimento" max="<?=date("Y-m-d")?>" required placeholder="Data de nascimento" value="<?=$cliente["dtnascimento"]?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Escolaridade:</label>
                                <div class="col-sm-10">          
                                    <select name="escolaridade" id="escolaridade" class="form-control">
                                        <option value="">--Selecione--</option>
                                        <option value="1" <?php if(isset($cliente["escolaridade"]) && $cliente["escolaridade"] == "1"){echo "selected";}?>>Fundamental</option>
                                        <option value="2" <?php if(isset($cliente["escolaridade"]) && $cliente["escolaridade"] == "2"){echo "selected";}?>>Ens. Médio</option>
                                        <option value="3" <?php if(isset($cliente["escolaridade"]) && $cliente["escolaridade"] == "3"){echo "selected";}?>>Ens. Técnico</option>
                                        <option value="4" <?php if(isset($cliente["escolaridade"]) && $cliente["escolaridade"] == "4"){echo "selected";}?>>Médio + Técnico</option>
                                        <option value="5" <?php if(isset($cliente["escolaridade"]) && $cliente["escolaridade"] == "5"){echo "selected";}?>>Tecnólogo</option>
                                        <option value="6" <?php if(isset($cliente["escolaridade"]) && $cliente["escolaridade"] == "6"){echo "selected";}?>>Bacharel</option>
                                        <option value="7" <?php if(isset($cliente["escolaridade"]) && $cliente["escolaridade"] == "7"){echo "selected";}?>>Licenciatura</option>
                                        <option value="8" <?php if(isset($cliente["escolaridade"]) && $cliente["escolaridade"] == "8"){echo "selected";}?>>Especialização / MBA</option>
                                        <option value="9" <?php if(isset($cliente["escolaridade"]) && $cliente["escolaridade"] == "9"){echo "selected";}?>>Mestrado</option>
                                        <option value="10" <?php if(isset($cliente["escolaridade"]) && $cliente["escolaridade"] == "10"){echo "selected";}?>>Doutorado</option>
                                        <option value="11" <?php if(isset($cliente["escolaridade"]) && $cliente["escolaridade"] == "11"){echo "selected";}?>>Pós Doutorado</option>
                                        <option value="11" <?php if(isset($cliente["escolaridade"]) && $cliente["escolaridade"] == "11"){echo "selected";}?>>Livre Docente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="senha">Senha:</label>
                                <div class="col-sm-10">          
                                    <input type="password" class="form-control ValidaSenha" name="senha" id="senha" maxlength="30" minlength="5" placeholder="Somente preencha caso queira atualizar senha" readonly onfocus="this.removeAttribute('readonly');" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="senha">Desativar Conta</label>
                                <div class="col-sm-1">          
                                    <input type="checkbox" class="form-control" name="codstatus" id="codstatus" title="Cuidado com essa ação não podera mais acessar o sistema" value="50" <?php if(isset($cliente["codstatus"]) && $cliente["codstatus"] == "50"){echo "checked";}?>>
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
