@extends('layouts.master')

@section('styles')
        @parent
        <link rel="stylesheet" type="text/css" href="{{ asset('css/agenda.css') }}">
@stop

@section('content')

        <div class="container container-height">
            <h1 class="text-center text-success">Agenda</h1>
            @if (session('AlertSuccess'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! session('AlertSuccess') !!}
                </div>
            @endif
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Detalhar Contato</strong></h3>
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
                                        <li>
                                            <a href="{{ route('contact.edit', $AddressBook->id) }}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                Editar
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body form-horizontal">
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="" class="col-sm-2 control-label">Nome:</label>
                            <div class="col-sm-10">
                                <p class="form-control">{{ $AddressBook->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="" class="col-sm-2 control-label">E-mail:</label>
                            <div class="col-sm-10">
                                <p class="form-control">{{ $AddressBook->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="" class="col-sm-2 control-label">CEP:</label>
                            <div class="col-sm-10">
                                <p class="form-control">{{ $AddressBook->zip_code }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="" class="col-sm-2 control-label">Endereço:</label>
                            <div class="col-sm-10">
                                <p class="form-control">{{ $AddressBook->address }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="" class="col-sm-2 control-label">Numero:</label>
                            <div class="col-sm-10">
                                <p class="form-control">{{ $AddressBook->number }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="" class="col-sm-2 control-label">Complemento:</label>
                            <div class="col-sm-10">
                                <p class="form-control">{{ $AddressBook->complement }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="" class="col-sm-2 control-label">Bairro:</label>
                            <div class="col-sm-10">
                                <p class="form-control">{{ $AddressBook->district }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="" class="col-sm-2 control-label">Cidade:</label>
                            <div class="col-sm-10">
                                <p class="form-control">{{ $AddressBook->city }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="" class="col-sm-2 control-label">UF:</label>
                            <div class="col-sm-10">
                                <p class="form-control">{{ $AddressBook->state }}</p>
                            </div>
                        </div>
                    </div>
                    <hr class="primary"/>
                    @if (count($AddressBook->PhoneNumbers) > 0)
                    <ul class="list-group">
                        @foreach($AddressBook->PhoneNumbers as $PhoneNumber)
                            <li class="list-group-item">
                                <p class="no-margin">{{ $PhoneNumber->PhoneType->name }} - <a href="tel:{{ $PhoneNumber->phone }}">{{ $PhoneNumber->phone }}</a></p>
                            </li>
                        @endforeach
                    </ul>
                    @else
                        <div class="alert laert-danger">
                            <p>Nenhum número de telefone adicionado.</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="panel-footer">
            </div>
        </div>

@endsection

@section('scripts')
        @parent
        <script src="/js/jquery.agenda.js"></script>
@stop