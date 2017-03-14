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
                    <h3 class="panel-title"><strong>Inserir Contato</strong></h3>
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
                                            <a href="{{ route('agenda') }}">
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
                    <form class="form-horizontal" role="form" name="mForm" action="{{ route('agenda.inserir.store') }}" method="post">
                        <fieldset>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="" class="col-sm-2 control-label">*Nome:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" maxlength="100" required>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Dados Complementares
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <label for="" class="col-sm-4 control-label">E-mail:</label>
                                                        <div class="col-sm-8">
                                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                                                        <label for="" class="col-sm-4 control-label">CEP:</label>
                                                        <div class="col-sm-8">
                                                        <input type="text" name="zip_code" value="{{ old('zip_code') }}" class="form-control zip-code" id="zip-code">
                                                        @if ($errors->has('zip_code'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('zip_code') }}</strong>
                                                            </span>
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="loader30x30 hide" id="loader-zip-code"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                                        <label for="address" class="col-sm-4 control-label">Endereço:</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="address">
                                                            @if ($errors->has('address'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('address') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                                                        <label for="number" class="col-sm-4 control-label">Número:</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="number" value="{{ old('number') }}" class="form-control" id="number">
                                                            @if ($errors->has('number'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('number') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-4 control-label">Complemento:</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="complemet" value="{{ old('complemet') }}" class="form-control" id="complemet">
                                                            @if ($errors->has('complemet'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('complemet') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">
                                                        <label for="" class="col-sm-4 control-label">Bairro:</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="district" value="{{ old('district') }}" class="form-control" id="district">
                                                            @if ($errors->has('district'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('district') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                                        <label for="" class="col-sm-4 control-label">Cidade:</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="city" value="{{ old('city') }}" class="form-control" id="city">
                                                            @if ($errors->has('city'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('city') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                                        <label for="" class="col-sm-4 control-label">UF:</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="state" value="{{ old('state') }}" class="form-control uf" id="state" maxlength="2">
                                                            @if ($errors->has('state'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('state') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table dynamic-list">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table class="table table-striped">
                                                        <tbody class="list-container">
                                                            <tr class="list-row">
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-xs-6">
                                                                            <div class="form-group {{ $errors->has('phone_type') ? ' has-error' : '' }}">
                                                                                <div class="col-sm-10">
                                                                                    <select name="phone_type[]" class="form-control" required>
                                                                                    @foreach ($PhoneTypes as $PhoneType)
                                                                                        <option value="{{ $PhoneType->id }}">{{ $PhoneType->name }}</option>
                                                                                    @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6">
                                                                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                                                <div class="col-sm-10">
                                                                                    <input type="tel" name="phone[]" value="" class="form-control phone" placeholder="Telefone" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn btn-danger btn-remove">
                                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td class="text-center vertical-bottom">
                                                    <button type="button" class="btn btn-success btn-add">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('agenda') }}" class="btn btn-default"><strong>Cancelar</strong></a>
                                        </div>
                                        <div class="btn-group" role="group"></div>
                                        <div class="btn-group" role="group">
                                            <button type="submit" class="btn btn-success"><strong>Cadastrar</strong></button>
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
