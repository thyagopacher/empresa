<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Libelula - Página Inicial</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.Jcrop.css') }}">

        <style>
            body {
                font-family: 'Lato';
            }

            .fa-btn {
                margin-right: 6px;
            }
        </style>

    </head> 
    <body id="app-layout">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <a class="navbar-brand" href="/home">Logo</a>
                </div>                
                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    @if (!Auth::guest())
                    <ul style="margin-top: 10px;" class="navbar-nav center-block">
                        <li style="list-style-type: none;">
                            <form action="ativar">
                                <input type="search" name="procurar" id="procurar" size="50"  class="form-control" placeholder="Procurar"/>
                            </form>
                        </li>
                    </ul>                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        <li>
                            <div style="padding: 15px;" class="dropdown">
                                <a href="#" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-align-justify"></span>
                                    <span class="caret"></span>
                                </a> 
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/perfil') }}">Perfil</a></li>
                                    <li><a href="{{ url('/privacidade') }}">Privacidade</a></li>
                                    @if (!Auth::guest() && Session::get("codstatus") != 1)
                                    <li><a href="{{ url('/conta/ativar') }}">Conta</a></li>
                                    @endif
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Sair</a></li>
                                </ul>
                            </div>

                        </li>
                    </ul>                    

                    @endif
                </div>
            </div>
        </nav>
        @yield('content')

        <!-- JavaScripts -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/DragandDropUpload.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.Jcrop.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/VerificaSenha.js') }}"></script>
        <script src="/js/sweet-alert.min.js"></script>
        <link href="/css/sweet-alert.min.css" rel="stylesheet">
    </body> 
</html>
