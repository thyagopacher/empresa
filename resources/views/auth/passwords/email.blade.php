<!DOCTYPE html>
<!-- saved from url=(0042)http://getbootstrap.com/examples/carousel/ -->
<html lang="pt">
    <head>
        @extends('inc.head')
    </head>
    <!-- NAVBAR 
    ================================================== -->
    <body cz-shortcut-listen="true">
        @extends('layouts.navbar')

        <!-- Marketing messaging and featurettes
        ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container-fluid">

            <!-- Three columns of text below the carousel -->
            <div class="row" style="margin: 155px 0px 0px 0px;">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <form class="form-horizontal" id="frecuperarSenha" role="form" method="POST" onsubmit="return false;" action="{{ url('/recuperar_senha') }}">
                        {!! csrf_field() !!}
                        <fieldset>
                            <legend>Recupere seu acesso</legend>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                

                                <div id="email_recuperar" class="col-md-6">
                                    <label id="label1" class="control-label">E-mail</label><br>
                                    <input type="email" class="form-control" name="email" id="emailRecuperarSenha" required value="{{ old('email') }}">
                                </div>
                                <div style="display: none" id="email_achado" class="radio">
                                    <label>Localizamos</label><br>
                                    <label id="email_achado2" class="control-label">
                                        <input style="width: 15px; float: left; height: 15px;" type="radio" class="form-control" name="envia_email" id="envia_email" value="s">
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="button" id="btLocalizar" class="btn btn-primary">Localizar</button>
                                    <button type="button" id="btCancelar" title="Clique aqui para cancelar a conta" class="btn btn-primary">Cancelar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>                   
                </div>
                <div class="col-md-4"></div>
            </div><!-- /.row -->

        </div><!-- /.container -->

        @extends('layouts.footer')
        @extends('inc.javascript')
    </body>
</html>