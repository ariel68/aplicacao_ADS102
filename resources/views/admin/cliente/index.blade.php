@extends('layouts.app')

@section('content')
<div class="container div-pai">
    <div class="mt-5">
        <div class="col-12 col-md-12">

            <div class="col-12">
                <h3>Clientes</h3>
            </div>
            @if (isset($sucesso))
                <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                    Sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="col-12">
                <a href="{{url('/')}}/clientes/new"><button class="btn btn-primary mb-2" type="button">Novo Cliente</button></a>
            </div>
            <div class="col-12">
                <form class="form-inline" action="{{url('/')}}/cliente/search" method="POST">
                    @csrf
                    <div class="col-12 text-right">
                        <div class="form-group">
                            <label for="">Pesquisa:</label>
                            <input class="form-control form-control-sm ml-1" type="text" name="texto" id="texto">
                            <select class="form-control form-control-sm ml-1" name="tipo" id="tipo">
                                <option value="nome">Nome</option>
                                <option value="cpf">CPF</option>
                                <option value="email">Email</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm ml-2">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 text-right">
                <form id="form-ordenar" action="{{url('/')}}/clientes/order" method="POST">
                    @csrf
                    <label for="ordem">Ordem:</label>
                    <select onchange="ordenar()" name="ordem" id="ordem">
                        <option value="nome" @if(isset($ordemNome)) selected @endif>Nome</option>
                        <option value="cpf" @if(isset($ordemCpf)) selected @endif>CPF</option>
                        <option value="email" @if(isset($ordemEmail)) selected @endif>Email</option>
                    </select>
                </form>
            </div>

            <div class="div-principal-tabela">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($clientes)>0)
                            @foreach ($clientes as $index=>$cliente)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$cliente->NomeCliente}}</td>
                                <td>{{$cliente->CPF}}</td>
                                <td>
                                    @if(empty($cliente->Email))
                                        ======
                                    @else
                                        {{$cliente->Email}}
                                    @endif
                                </td>
                                <td><a href="{{url('/')}}/cliente/edit/{{$cliente->id}}">Editar</a></td>
                            </tr>  
                            @endforeach
                        @else
                            <tr>
                                <th></th>
                                <td>Nenhum cliente cadastrado</td>
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
                {{ $clientes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptPersonalizado')
    <script src="{{ asset('js/cliente.js') }}"></script>
@endsection


