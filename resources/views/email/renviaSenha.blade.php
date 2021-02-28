@extends('beautymail::templates.widgets')

@section('content')

    @include('beautymail::templates.widgets.articleStart')

        <h4 class="secondary"><strong>Lembrete de senha</strong></h4>
        <p>Sua senha no sistema troque ela o quanto antes para sua segurança: {{ $senha }}</p>

    @include('beautymail::templates.widgets.articleEnd')

@stop