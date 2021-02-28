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
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        <fieldset>
                            <legend>Recupere seu acesso</legend>
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-mail</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Senha</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Confirmar senha</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-refresh"></i>Redefinir senha
                                    </button>
                                </div>
                            </div>                            

                        </fieldset>

                    </form>                    
                </div>
                <div class="col-md-2"></div>
            </div><!-- /.row -->

        </div><!-- /.container -->

        @extends('layouts.footer')
        @extends('inc.javascript')
    </body>
</html>