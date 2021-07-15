@extends('layouts.app')
@section('estiloPersonalizado')
    <link href="{{ asset('css/cliente.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container div-pai">
    <div class="mt-5">
        <div class="col-12 col-md-12">

            <div class="col-12 mb-3">
                <a href="{{url('/')}}/clientes"><button class="btn btn-secondary" type="button">Clientes</button></a>
                <button id="btn-cliente" class="btn btn-primary" type="button">Cliente</button>
                <button id="btn-pedidos" id="btn-" class="btn btn-secondary" type="button">Pedidos</button>
            </div>

            @if (isset($sucesso))
                <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                    Sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (isset($erro))
                <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                    {{$erro}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            <div id="div-cliente" class="col-12">
                <div class="col-12 col-md-6 offset-md-3">
                    <h4>Dados do cliente</h4>
                    <hr>
                </div>
                <div class="col-12 col-md-6 offset-md-3 pb-3">
                    <form class="form" action="{{url('/')}}/clientes/put" method="POST">
                        @csrf
                        <input type="text" id="idCliente" name="idCliente" hidden readonly value="{{$cliente->id}}">
                        
                        <div class="form-group mr-3 mb-3">
                            <label for="nome">Nome*</label>
                            <input class="form-control ml-1" type="text" id="nome" name="nome" value="{{ $cliente->NomeCliente }}">
                            @error('nome')<span class="mensagem-erro">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group mr-3 mb-3">
                            <label for="cpf">CPF*</label>
                            <input class="form-control ml-1" type="text" id="cpf" name="cpf" value="{{ $cliente->CPF }}">
                            @error('cpf')<span class="mensagem-erro">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group mb-3 mr-3">
                            <label for="email">Email</label>
                            <input class="form-control ml-1" type="email" id="email" name="email" value="{{ $cliente->Email }}">
                            @error('email')<span class="mensagem-erro">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-12 row p-0">
                            <div class="col-6 text-left p-0">
                                <button type="button" onclick="confirmExcluir('{{url('/')}}/cliente/delete/{{$cliente->id}}')" class="btn btn-danger">Excluir</button>
                            </div>
                            <div class="col-6 text-right p-0">
                                <button class="btn btn-success">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div id="div-pedidos" class="col-12">
                <div class="col-12">
                    <h4>Pedidos do Cliente</h4>
                    <hr>
                </div>
                <div class="div-principal-tabela">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Número pedido</th>
                            <th scope="col">Data</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($cliente->pedidos)>0)
                                @foreach ($cliente->pedidos as $index=>$pedido)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{$pedido->NumeroPedido}}</td>
                                    <td>{{date( 'd/m/Y' , strtotime($pedido->DtPedido)) }}</td>
                                    <td><a href="{{url('/')}}/pedido/edit/{{$pedido->NumeroPedido}}">Detalhes</a></td>
                                </tr>  
                                @endforeach
                            @else
                                <tr>
                                    <th></th>
                                    <td>Nenhum Pedido para este cliente</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>  
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            
            
            
        </div>
    </div>
</div>
@endsection

@section('scriptPersonalizado')
    <script src="{{ asset('js/editCliente.js') }}"></script>
@endsection
