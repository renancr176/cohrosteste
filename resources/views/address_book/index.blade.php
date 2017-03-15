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
                    <h3 class="panel-title"><strong>Contatos</strong></h3>
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
                                            <a href="{{ route('contact.create') }}">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i> 
                                                Novo contato
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if (count($AddressBooks) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($AddressBooks as $AddressBook)
                        <tbody>
                            <tr>
                                <td>{{ $AddressBook->name }}</td>
                                <td>{{ $AddressBook->email }}</td>
                                <td>
                                    <a href="{{ route('contact.show', $AddressBook->id) }}" class="btn btn-primary">Detalhar</a> 
                                </td>
                                <td>
                                    <form action="{{ route('contact.destroy', $AddressBook->id) }}" method="post" id="deleteContact">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @else
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <h3 class="text-center">Nenhuma contato encontrado.</h3>
                    </div>
                    @endif
                </div>
                <div class="panel-footer text-center">
                    @if (count($AddressBooks) > 0)
                        {{ $AddressBooks->render() }}
                    @endif
                </div>
            </div>
        </div>

@endsection

@section('scripts')
        @parent
        <script src="/js/jquery.agenda.js"></script>
@stop