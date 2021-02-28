@extends('beautymail::templates.widgets')

@section('content')

    @include('beautymail::templates.widgets.articleStart')

        <h4 class="secondary"><strong>Troca de senha</strong></h4>
        <p>Sua senha foi atualizada no sistema marque bem: {{ $senhaCliente }}</p>

    @include('beautymail::templates.widgets.articleEnd')

@stop