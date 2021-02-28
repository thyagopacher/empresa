@extends('beautymail::templates.widgets')

@section('content')

    @include('beautymail::templates.widgets.articleStart')

        <h4 class="secondary"><strong>Envio de Token</strong></h4>
        <p>Seu token para acesso ao sistema é: {{ $tokenCliente }}</p>

    @include('beautymail::templates.widgets.articleEnd')

@stop