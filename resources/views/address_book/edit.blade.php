@extends('layouts.master')

@section('styles')
        @parent
        <link rel="stylesheet" type="text/css" href="{{ asset('css/agenda.css') }}">
@stop

@section('content')

        <div class="container container-height">
            <h1 class="text-center text-success">Editar Contato</h1>
        </div>

@endsection

@section('scripts')
        @parent
        <script src="/js/jquery.agenda.js"></script>
@stop