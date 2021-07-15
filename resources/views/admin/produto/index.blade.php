@extends('layouts.app')

@section('content')
<div class="container div-pai">
    <div class="mt-5">
        <div class="col-12 col-md-12">

            <div class="col-12">
                <h3>Produtos</h3>
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
                <a href="{{url('/')}}/produtos/new"><button class="btn btn-primary mb-2" type="button">Novo Produto</button></a>
            </div>
            <div class="col-12">
                <form class="form-inline" action="{{url('/')}}/produto/search" method="POST">
                    @csrf
                    <div class="col-12 text-right">
                        <div class="form-group">
                            <label for="">Pesquisa:</label>
                            <input class="form-control form-control-sm ml-1" type="text" name="texto" id="texto">
                            <select class="form-control form-control-sm ml-1" name="tipo" id="tipo">
                                <option value="nome">Nome</option>
                                <option value="codBarras">Cód. Barras</option>
                                <option value="valor">Valor</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm ml-2">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 text-right">
                <form id="form-ordenar" action="{{url('/')}}/produtos/order" method="POST">
                    @csrf
                    <label for="ordem">Ordem:</label>
                    <select onchange="ordenar()" name="ordem" id="ordem">
                        <option value="nome" @if(isset($ordemNome)) selected @endif>Nome</option>
                        <option value="codBarras" @if(isset($ordemCpf)) selected @endif>Cód. Barras</option>
                        <option value="valor" @if(isset($ordemEmail)) selected @endif>Valor</option>
                    </select>
                </form>
            </div>

            <div class="div-principal-tabela">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Código de barras</th>
                        <th scope="col">Valor Unit.</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($produtos)>0)
                            @foreach ($produtos as $index=>$produto)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$produto->NomeProduto}}</td>
                                <td>{{$produto->CodBarras}}</td>
                                <td>{{str_replace('.',',',number_format($produto->ValorUnitario,2))}}</td>
                                <td><a href="{{url('/')}}/produto/edit/{{$produto->id}}">Editar</a></td>
                            </tr>  
                            @endforeach
                        @else
                            <tr>
                                <th></th>
                                <td>Nenhum produto cadastrado</td>
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
                {{ $produtos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptPersonalizado')
    <script src="{{ asset('js/produto.js') }}"></script>
@endsection


