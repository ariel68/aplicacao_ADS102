@extends('layouts.app')

@section('content')
<div class="container div-pai">
    <div class="mt-5">
        <div class="col-12 col-md-12">
            @if (isset($erro))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Erro</strong> {{$erro}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="col-12">
                <a href="{{url('/')}}/pedidos"><button class="btn btn-primary mb-2" type="button">Voltar</button></a>
            </div>
            <div class="col-12 col-md-10 offset-md-1">
                @if (isset($pedido))
                <h3>Pedido Número: {{$pedido->NumeroPedido}}</h3>
                <h5>Data: {{date( 'd/m/Y' , strtotime($pedido->DtPedido))}}</h5>
                <div class="col-12 text-left p-0">
                    <form id="form-troca-status" class="form-inline" action="{{url('/')}}/pedido/trocastatus" method="POST">
                        @csrf
                        <input type="text" id="idPedidoStatus" name="idPedidoStatus" hidden readonly value="{{$pedido->NumeroPedido}}">
                        <div class="form-row">
                            <label for="status"><b>Status:</b></label>
                            <select id="select-status" class="form-control" name="status" id="status">
                                <option value="ABERTO" @if($pedido->status == 'ABERTO') selected @endif>ABERTO</option>
                                <option value="PAGO" @if($pedido->status == 'PAGO') selected @endif>PAGO</option>
                                <option value="CANCELADO" @if($pedido->status == 'CANCELADO') selected @endif>CANCELADO</option>
                            </select>
                        </div>
                    </form>
                </div>
                    <div class="col-12 text-right">
                        <button onclick="confirmaExcluir('{{$pedido->NumeroPedido}}')" type="button" class="btn btn-danger">Excluir Pedido</button>
                    </div>
                @else
                    <h3>Novo Pedido</h3>  
                @endif
                <hr>
            </div>

            <div class="col-12 col-md-10 offset-md-1 pb-5">
                <form action="{{url('/')}}/pedidos/pedidocliente" method="POST">
                    @csrf
                    <input type="text" name="idPedido" id="idPedido" hidden readonly
                        value="{{$pedido->NumeroPedido ?? ""}}">
                    <input type="text" name="baseURL" id="baseURL" value="{{url('/')}}/" hidden readonly>

                    <div class="form-row">
                        <div class="col">
                            <label for="nome">Cliente</label>
                            <input type="text" id="idCliente" name="idCliente" value="{{$cliente->id}}" hidden readonly>
                            <input class="form-control" type="text" value="{{$cliente->NomeCliente}}" readonly>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input class="form-control" type="text" value="{{$cliente->CPF}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-0 text-right">
                        <a href="{{url('/')}}/cliente/edit/{{$cliente->id}}" target="_blank">Detalhes do cliente</a>
                    </div>


                    <div class="col-12 text-center">
                        <h4><b>Adicionar produtos</b></h4>
                    </div>
                    <div class="form-group">
                        <label for="produto">Produto</label>
                        <select class="form-control" name="idProduto" id="idProduto">
                            @foreach ($produtos as $produto)
                            <option value="{{$produto->id}}">{{$produto->NomeProduto}} - Código barras:
                                {{$produto->CodBarras}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="col-12 col-md-4">
                            <label for="quantidade">Quantidade</label>
                            <input class="form-control" type="number" id="quantidade" name="quantidade">
                        </div>
                        <div class="col-12 col-md-2 text-right pt-3 align-self-center">
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="col container-fluid">
    <div class="col-12">
        @if (isset($pedido))
        <div class="col-12 p-0 mb-4 mt-5">
            <div class="col-12 text-left">
                <p><b>PRODUTOS</b></p>
            </div>
            <div class="itens-pedido">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome Produto</th>
                            <th scope="col">Código de barras</th>
                            <th scope="col">Preço unit.</th>
                            <th scope="col">Qtd.</th>
                            <th scope="col">Total item</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->produtos as $index=>$produto)
                        <tr>
                            <th>{{$index + 1}}</th>
                            <td>{{$produto->NomeProduto}}</td>
                            <td>{{$produto->CodBarras}}</td>
                            <td>{{str_replace('.',',',number_format($produto->ValorUnitario,2))}}</td>
                            <td>
                                <input
                                    onchange="trocarQuantidade('{{$pedido->NumeroPedido}}','{{$produto->id}}', $(this).val(),'{{$produto->ValorUnitario}}' )"
                                    type="number" min="1" id="quantidadeEdit" name="quantidadeEdit"
                                    value="{{$produto->pivot->Quantidade}}">
                            </td>
                            <td>
                                <span  class="valorTotal{{$produto->id}}">{{str_replace('.',',',number_format($produto->pivot->Quantidade * $produto->ValorUnitario,2))}}</span>
                                <input type="number" class="valor-total-class valorTotal{{$produto->id}}" value="{{$produto->pivot->Quantidade * $produto->ValorUnitario}}" hidden>
                            </td>
                            <td><a href="{{url('/')}}/pedidos/delete/produtopedido/{{$pedido->NumeroPedido}}/{{$produto->id}}">Excluir</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-12 text-right pr-5">
                    <h4><b>Total:</b> <span id="totalPedido"></span></h4>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
@section('scriptPersonalizado')
<script src="{{ asset('js/newPedido.js') }}"></script>
@endsection