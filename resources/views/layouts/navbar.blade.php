<div class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Libelula</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
             
            <form action="/login" onsubmit="return false;" class="navbar-form navbar-right" method="post" role="form" id="fLogin">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="email" class="form-control" name="email" max="100" maxlength="255" minlength="5" placeholder="e-mail" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" maxlength="255" minlength="5" placeholder="senha" required>
                </div>
                <button type="submit" id="btLogin" cslass="btn btn-primary"> Entrar</button><Br>
                <div class="col-md-8"></div>
                <a class="btn btn-link" href="{{ url('/senha/recuperar') }}">Ajuda ?</a>
            </form>
        </div>
    </div>
</div> 