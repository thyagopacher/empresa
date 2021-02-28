 
@extends('layouts.app') 

@section('content')
<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

<div class="container-fluid">
    <div class="row topo">
        <div class="col-md-3" id="aplicativos_lista">
            <div class="col-md-12">
                <h5>APLICATIVOS</h5>
            </div>
            <div class="col-md-12">
                <div class="list-group">                 
                    <a href="/perfil" class="list-group-item">Perfil</a>
                    <a href="/conta/ativar" class="list-group-item">Conta</a>                    
                    <a href="#" class="list-group-item active">
                        <i class="fa fa-calendar" aria-hidden="true"></i>  
                        Mirante
                    </a>
                    <a href="#" class="list-group-item">Mirante 2</a>
                    <a href="#" class="list-group-item">Scrap Road</a>
                    <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                    <a href="#" class="list-group-item">Vestibulum at eros</a>
                </div>               
            </div>
        </div>
        <div class="col-md-6">
            <?php 
            $urlCapa = '/mostraCapa';
            if ($urlCapa != NULL && $urlCapa != "") {
                $backgroundCapa = 'background: url(' . $urlCapa . '); background-size: 100% 100%';
            } else {
                $urlCapa = 'img/sem_imagem.png';
                $backgroundCapa = 'background: url(img/sem_imagem.png);    background-size: 100% 100%';
            }

            if ($objeto["imagem"] != NULL && $objeto["imagem"] != "") {
                $backgroundImg = 'background: url(img/' . $objeto["imagem"] . '); background-size: 100% 100%';
            } else {
                $backgroundImg = 'background: url(img/sem_imagem.png); background-size: 100% 100%';
            }
            ?>
            <div id="painel_capa_background" class="panel panel-default" style="{{$backgroundCapa}}">
                <input type="hidden" id="urlCapa" value="{{$urlCapa}}"/>

                <div class="panel-body">
                    <article>

                        <div id="holder"></div> 
                        <p id="upload" class="hidden"><label>Drag &amp; drop não é suportado, você ainda pode fazer o upload escolhendo o arquivo:<br><input type="file"></label></p>
                        <p id="filereader">File API &amp; FileReader API não é suportado</p>
                        <p id="formdata">XHR2's FormData não é suportado</p>
                        <p id="progress">XHR2's upload progress não é suportado</p>
                        <p class="p_upload_capa" style="display: none">Upload em progresso: <progress id="uploadprogress" max="100" value="0">0</progress></p>
                        <p class="p_upload_capa" style="display: none">Drag an image from your desktop on to the drop zone above to see the browser both render the preview, but also upload automatically to this server.</p>
                    </article>                    
                </div>
            </div>
            <div id="painel_foto_background" class="panel panel-default" ondragover="return false" ondragend="return false;" ondrop="pegaImagem(event)"  style="{{$backgroundImg}}">
                <div class="panel-body">
                    <article>
                        <div id="holder2"></div>           
                        <p id="upload2" class="hidden"><label>Drag &amp; drop não é suportado, você ainda pode fazer o upload escolhendo o arquivo:<br><input type="file"></label></p>
                        <p id="filereader2">File API &amp; FileReader API não é suportado</p>
                        <p id="formdata2">XHR2's FormData não é suportado</p>
                        <p id="progress2">XHR2's upload progress não é suportado</p>
                        <p class="p_upload_capa" style="display: none">Upload em progresso: <progress id="uploadprogress2" max="100" value="0">0</progress></p>
                        <p class="p_upload_capa" style="display: none">Drag an image from your desktop on to the drop zone above to see the browser both render the preview, but also upload automatically to this server.</p>                            
                    </article> 
                </div>
                <div id="alterarFoto" style="display: none"><i class="fa fa-camera" aria-hidden="true"></i> Alterar foto</div>
            </div>
            <!-- This is the form that our event handler fills -->
            <form style="width: 110px;float: left;margin-right: 10px;" action="/cortar_capa" method="post" onsubmit="return checkCoords();">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
                <input type="submit" value="Cortar Imagem" id="btCortarImagem" style="display: none" class="btn btn-large btn-inverse" />
                <input type="submit" value="Zerar Imagem" id="btZerarImagem" class="btn btn-large btn-inverse" />
            </form>            
            <input style="float: right;margin-left: 5px;" type="button" value="Excluir Capa" onclick="location.href = '/excluirCapa'" class="btn btn-large btn-inverse" />
            <input style="float: right;margin-left: 5px;" type="button" value="Excluir Foto" onclick="location.href = '/excluirImagem'" class="btn btn-large btn-inverse" />

            <div class="row">
                <div class="col-md-12">
                    <div class="timeline">
                         
                        <!-- Line component -->
                        <div class="line text-muted"></div>

                        <!-- Separator -->
                        <div class="separator text-muted">
                            <time>26. 3. 2015</time>
                        </div>
                        <!-- /Separator -->

                        <!-- Panel -->
                        <article class="panel panel-danger panel-outline">

                            <!-- Icon -->
                            <div class="panel-heading icon">
                                <i class="glyphicon glyphicon-heart"></i>
                            </div>
                            <!-- /Icon -->

                            <!-- Body -->
                            <div class="panel-body">
                                <strong>Someone</strong> favourited your photo.
                            </div>
                            <!-- /Body -->

                        </article>
                        <!-- /Panel -->

                        <!-- Panel -->
                        <article class="panel panel-default panel-outline">

                            <!-- Icon -->
                            <div class="panel-heading icon">
                                <i class="glyphicon glyphicon-picture"></i>
                            </div>
                            <!-- /Icon -->

                            <!-- Body -->
                            <div class="panel-body">
                                <img class="img-responsive img-rounded" src="//placehold.it/350x150" />
                            </div>
                            <!-- /Body -->

                        </article>
                        <!-- /Panel -->

                        <!-- Panel -->
                        <article class="panel panel-primary">

                            <!-- Icon -->
                            <div class="panel-heading icon">
                                <i class="glyphicon glyphicon-plus"></i>
                            </div>
                            <!-- /Icon -->

                            <!-- Heading -->
                            <div class="panel-heading">
                                <h2 class="panel-title">New content added</h2>
                            </div>
                            <!-- /Heading -->

                            <!-- Body -->
                            <div class="panel-body">
                                Some new content has been added.
                            </div>
                            <!-- /Body -->

                            <!-- Footer -->
                            <div class="panel-footer">
                                <small>Footer is also supported!</small>
                            </div>
                            <!-- /Footer -->

                        </article>
                        <!-- /Panel -->

                        <!-- Separator -->
                        <div class="separator text-muted">
                            <time>25. 3. 2015</time>
                        </div>
                        <!-- /Separator -->

                        <!-- Panel -->
                        <article class="panel panel-success">

                            <!-- Icon -->
                            <div class="panel-heading icon">
                                <i class="glyphicon glyphicon-plus"></i>
                            </div>
                            <!-- /Icon -->

                            <!-- Heading -->
                            <div class="panel-heading">
                                <h2 class="panel-title">New content added</h2>
                            </div>
                            <!-- /Heading -->

                            <!-- Body -->
                            <div class="panel-body">
                                Anything you can do with <code>.panel</code>, can be done in timeline too!
                            </div>
                            <!-- /Body -->

                            <!-- List group -->
                            <ul class="list-group">
                                <li class="list-group-item">Like</li>
                                <li class="list-group-item">list</li>
                                <li class="list-group-item">groups</li>
                                <li class="list-group-item">and</li>
                                <li class="list-group-item">tables</li>
                            </ul>

                        </article>
                        <!-- /Panel -->

                        <!-- Panel -->
                        <article class="panel panel-info panel-outline">

                            <!-- Icon -->
                            <div class="panel-heading icon">
                                <i class="glyphicon glyphicon-info-sign"></i>
                            </div>
                            <!-- /Icon -->

                            <!-- Body -->
                            <div class="panel-body">
                                That is all.
                            </div>
                            <!-- /Body -->

                        </article>
                        <!-- /Panel -->

                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-3">
            <div class="col-md-12">
                <h5>ANÚNCIOS</h5>
            </div>
            <div class="col-md-12">2</div>
            <div class="col-md-12">3</div>
            <div class="col-md-12">4</div>
        </div>
    </div>
</div>
@endsection
