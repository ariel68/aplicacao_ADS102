<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Pedido;
use App\Produto;
use Exception;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(){
        return view('admin.pedido.index')->with(['pedidos' => Pedido::orderBy('DtPedido','DESC')->paginate(20), 'clientes' => Cliente::orderBy('NomeCliente', 'ASC')->get()]);
    }
    public function new(Request $request){
        if(isset($request->cliente)){
            return view('admin.pedido.newpedido')->with(['cliente' => Cliente::find($request->cliente), 'produtos' => Produto::get()]);
        }else{
            return view('erros.500');
        }
        
    }
    public function pedidoDetalhe(Request $request){
        $pedido = Pedido::find($request->NumeroPedido);
        return view('admin.pedido.newpedido')->with(['cliente' => Cliente::find($pedido->cliente_id), 'produtos' => Produto::get(), 'pedido' => $pedido]);
    }

    public function pedidoCliente(Request $request){
        try{
            if(!$request->idPedido > 0){
                $cliente = Cliente::find($request->idCliente);
                $produto = Produto::find($request->idProduto);
                $quantidade = $request->quantidade;
                if($quantidade < 1){
                    $quantidade = 1;
                }
                $pedido = New Pedido();
                $pedido->cliente_id = $cliente->id;
                $pedido->DtPedido = now();
                $pedido->save();
                $pedido->produtos()->attach($produto,['Quantidade' => $quantidade, 'produto_id' => $produto->id]);

                return view('admin.pedido.newpedido')->with(['cliente' => $cliente, 'produtos' => Produto::get(), 'pedido' => $pedido]);
            }else{
                $cliente = Cliente::find($request->idCliente);
                $produto = Produto::find($request->idProduto);
                $quantidade = $request->quantidade;
                if($quantidade < 1){
                    $quantidade = 1;
                }
                $pedido = Pedido::find($request->idPedido);
                if($pedido->produtos->contains($produto)){
                   return view('admin.pedido.newpedido')->with(['cliente' => $cliente, 'produtos' => Produto::get(), 'pedido' => $pedido, 'erro' => 'Produto já existe na lista']); 
                }else{
                    $pedido->produtos()->attach($produto,['Quantidade' => $quantidade, 'produto_id' => $produto->id]);
                    $pedido->save();
                    $pedido = Pedido::find($request->idPedido);
                    return view('admin.pedido.newpedido')->with(['cliente' => $cliente, 'produtos' => Produto::get(), 'pedido' => $pedido]);
                }
            }
            
        }catch(Exception $e){
            return view('erros.500')->with(['mensagem' => $e]);
        }
    }

    public function deleteProdutoPedido(Request $request){
        try{
            $pedido = Pedido::find($request->NumeroPedido);
            if(count($pedido->produtos) == 1){
                return view('admin.pedido.newpedido')->with(['cliente' => Cliente::find($pedido->cliente_id), 'produtos' => Produto::get(), 'pedido' => $pedido, 'erro'=>'Não é permitido pedido sem produto!']);
            }
            $produto = Produto::find($request->idProduto);
            $pedido->produtos()->detach($produto);

            $pedido = Pedido::find($request->NumeroPedido);
            return view('admin.pedido.newpedido')->with(['cliente' => Cliente::find($pedido->cliente_id), 'produtos' => Produto::get(), 'pedido' => $pedido]);

        }catch(Exception $e){
            return view('erros.500')->with(['mensagem' => $e]);
        }
    }
    public function editProdutoPedido(Request $request){
        try{
            $pedido = Pedido::find($request->NumeroPedido);
            $produto = Produto::find($request->idProduto);
            $pedido->produtos()->updateExistingPivot($produto->id,['Quantidade' => $request->quantidade]);
            $pedido->save();
        }catch(Exception $e){
            
        }
    }

    public function trocaStatus(Request $request){
        try{
            $pedido = Pedido::find($request->idPedidoStatus);
            $pedido->status = $request->status;
            $pedido->save();
            return view('admin.pedido.newpedido')->with(['cliente' => Cliente::find($pedido->cliente_id), 'produtos' => Produto::get(), 'pedido' => $pedido]);
        }catch(Exception $e){
            return view('erros.500')->with(['mensagem' => $e]);
        }
    }

    public function delete(Request $request){
        try{
            $pedido = Pedido::find($request->numeroPedido);
            $pedido->produtos()->detach();
            $pedido->delete();
            return view('admin.pedido.index')->with(['pedidos' => Pedido::orderBy('DtPedido','DESC')->paginate(20), 'clientes' => Cliente::orderBy('NomeCliente', 'ASC')->get(), 'sucesso'=>'Pedido Excluído!']);
        }catch(Exception $e){
            return view('erros.500')->with(['mensagem' => $e]);
        }
    }

    public function get(){
        return response()->json(['response' => 'success', 'pedidos' => Pedido::get()]);
    }

    public function search(Request $request){
        switch ($request->tipo) {
            case 'numeroPedido':
                return view('admin.pedido.index')->with(['pedidos' => Pedido::where('NumeroPedido','LIKE', $request->texto."%")->paginate(20), 'clientes' => Cliente::orderBy('NomeCliente', 'ASC')->get()]);
            case 'cliente':
                return view('admin.pedido.index')->with(['pedidos' => Pedido::join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')->where('clientes.NomeCliente', 'LIKE', $request->texto.'%')->paginate(20), 'clientes' => Cliente::orderBy('NomeCliente', 'ASC')->get()]);
            case 'data':
                return view('admin.pedido.index')->with(['pedidos' => Pedido::whereDate('DtPedido', '=', $request->texto)->paginate(20), 'clientes' => Cliente::orderBy('NomeCliente', 'ASC')->get()]);
        }
    }
    public function order(Request $request){
        switch ($request->ordem) {
            case 'numeroPedido':
                return view('admin.pedido.index')->with(['pedidos' => Pedido::orderBy('NumeroPedido', 'ASC')->paginate(20), 'orderNumero' => true, 'clientes' => Cliente::orderBy('NomeCliente', 'ASC')->get()]);
            case 'cliente':
                return view('admin.pedido.index')->with(['pedidos' => Pedido::join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')->where('clientes.NomeCliente', 'LIKE', $request->texto.'%')->orderBy('clientes.NomeCliente','ASC')->paginate(20), 'ordemCliente' => true, 'clientes' => Cliente::orderBy('NomeCliente', 'ASC')->get()]);
            case 'data':
                return view('admin.pedido.index')->with(['pedidos' => Pedido::orderBy('DtPedido', 'DESC')->paginate(20) , 'ordemData' => true, 'clientes' => Cliente::orderBy('NomeCliente', 'ASC')->get()]);
        }
    }
}
