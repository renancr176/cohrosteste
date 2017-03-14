@extends('layouts.master')

@section('styles')
        @parent
        <link rel="stylesheet" type="text/css" href="{{ asset('css/agenda.css') }}">
@stop

@section('content')

        <div class="container container-height">
            <h1 class="text-center text-success">Agenda</h1>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Editar Contato</strong></h3>
                    <div class="panel-heading-btn navbar-right">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown" type="button">
                                        Menu
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('contact') }}">
                                                <i class="fa fa-reply" aria-hidden="true"></i>
                                                Voltar
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" name="mForm" action="{{ route('contact.update', $AddressBook->id) }}" method="post">
                        <fieldset>
                            {{ csrf_field() }}
                            @include('address_book.form')
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('contact.show', $AddressBook->id) }}" class="btn btn-default"><strong>Cancelar</strong></a>
                                        </div>
                                        <div class="btn-group" role="group"></div>
                                        <div class="btn-group" role="group">
                                            <button type="submit" class="btn btn-primary"><strong>Atualizar</strong></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

@endsection

@section('scripts')
        @parent
        <script src="/js/jquery.dynamic-list.js"></script>
        <script src="/js/jquery.maskedinput.min.js"></script>
        <script src="/js/jquery.agenda.js"></script>
@stop
