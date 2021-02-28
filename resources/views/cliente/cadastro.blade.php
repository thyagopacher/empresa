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
                <div class="col-md-8">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class=""></li>
                            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                            <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item">
                                <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <h1>A melhor rede social</h1>
                                        <p>É gratuito e sempre será</p>
                                        <p><a class="btn btn-lg btn-primary" href="/cliente/cadastro" role="button">Registre-se hoje</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <h1>Another example headline.</h1>
                                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                        <p><a class="btn btn-lg btn-primary" href="http://getbootstrap.com/examples/carousel/#" role="button">Learn more</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="item active">
                                <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <h1>One more for good measure.</h1>
                                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                        <p><a class="btn btn-lg btn-primary" href="http://getbootstrap.com/examples/carousel/#" role="button">Browse gallery</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="left carousel-control" href="http://getbootstrap.com/examples/carousel/#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="right carousel-control" href="http://getbootstrap.com/examples/carousel/#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                    </div><!-- /.carousel -->                      
                </div>
                <div class="col-md-4">
                    <form class="form-horizontal right" id="fcadastro" role="form" method="post" action="/inserir_cliente" onsubmit="return false">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <fieldset>
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="nome" id="nome" required title="nome do cliente" placeholder="nome">
                                </div>
                                <div class="col-sm-3">          
                                    <input type="text" class="form-control" name="sobrenome" id="sobrenome" required title="sobrenome do cliente" placeholder="sobrenome">
                                </div>                            
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6">          
                                    <input type="email" class="form-control" name="email" id="email" required title="e-mail do cliente" placeholder="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">          
                                    <input type="email" class="form-control" name="confirmeemail" id="confirmeemail" required title="confirme e-mail do cliente" placeholder="confirme email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">          
                                    <input type="password" class="form-control ValidaSenha" name="senha" id="senha" required title="senha para o cliente acessar"  readonly onfocus="this.removeAttribute('readonly');" placeholder="senha">
                                    <div id="messages"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">          
                                    <input type="radio" name="sexo" id="sexo1" value="f" required> Feminino
                                    <input type="radio" name="sexo" id="sexo2" value="m" required> Masculino
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-1" for="senha">Aniversário:</label><br><br> 
                                <div class="col-sm-6">          
                                    <input type="date" class="form-control data" name="dtnascimento" id="dtnascimento" required title="dt. nascimento"  placeholder="dt. nascimento">

                                </div>
                            </div>                        
                            <div class="form-group">        
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="button" id="btnCadastrar" class="btn btn-default">Criar a conta</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>                    
                </div>

            </div><!-- /.row -->

        </div><!-- /.container -->

        @extends('layouts.footer')
        @extends('inc.javascript')
    </body>
</html>