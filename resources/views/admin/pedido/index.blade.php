@extends('layouts.app')

@section('content')
<div class="container div-pai">
    <div class="mt-5">
        <div class="col-12 col-md-12">

            @if (isset($sucesso))
                <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                    Sucesso! {{$sucesso ?? ""}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="col-12">
                <h3>Novo Pedido</h3>
                <small>Selecione um cliente para gerar um novo pedido.</small>
            </div>
            <div class="col-12">
                <form class="form-inline mb-3" action="{{url('/')}}/pedidos/new" method="POST">
                    @csrf
                    <select class="form-control" name="cliente" id="cliente">
                        @foreach ($clientes as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->NomeCliente}} - {{$cliente->CPF}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary my-auto" type="submit">Novo Pedido</button>
                </form>
                <hr>
            </div>
            <div class="col-12">
                <h3>Pedidos</h3>
            </div>
            <div class="col-12">
                <form class="form-inline" action="{{url('/')}}/pedido/search" method="POST">
                    @csrf
                    <div class="col-12 text-right">
                        <div class="form-group">
                            <label for="">Pesquisa:</label>
                            <input class="form-control form-control-sm ml-1" type="text" name="texto" id="texto">
                            <select class="form-control form-control-sm ml-1" name="tipo" id="tipo">
                                <option value="numeroPedido">Numero Pedido</option>
                                <option value="cliente">Cliente</option>
                                <option value="data">Data</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm ml-2">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 text-right">
                <form id="form-ordenar" action="{{url('/')}}/pedidos/order" method="POST">
                    @csrf
                    <label for="ordem">Ordem:</label>
                    <select onchange="ordenar()" name="ordem" id="ordem">
                        <option value="numeroPedido" @if(isset($ordemNumero)) selected @endif>Número Pedido</option>
                        <option value="cliente" @if(isset($ordemCliente)) selected @endif>Nome Cliente</option>
                        <option value="data" @if(isset($ordemData)) selected @endif>Data</option>
                    </select>
                </form>
            </div>
        
            <div class="div-principal-tabela">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Número Pedido</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Data</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($pedidos)>0)
                            @foreach ($pedidos as $index=>$pedido)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$pedido->NumeroPedido}}</td>
                                <td>{{$pedido->cliente->NomeCliente}}</td>
                                <td>{{ date( 'd/m/Y' , strtotime($pedido->DtPedido)) }}</td>
                                <td>{{$pedido->status}}</td>
                                <td><a href="{{url('/')}}/pedido/edit/{{$pedido->NumeroPedido}}">Editar</a></td>
                            </tr>  
                            @endforeach
                        @else
                            <tr>
                                <th></th>
                                <td>Nenhum pedido cadastrado</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>  
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-6 offset-5 text-center">
                {{ $pedidos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptPersonalizado')
    <script src="{{ asset('js/pedido.js') }}"></script>
@endsection


