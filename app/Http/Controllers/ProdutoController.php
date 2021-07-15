<?php

namespace App\Http\Controllers;

use App\Produto;
use Exception;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(){
        return view('admin.produto.index')->with(['produtos' => Produto::orderBy('NomeProduto','ASC')->paginate(20)]);
    }
    public function new(){
        return view('admin.produto.newproduto');
    }
    public function edit(Request $request){
        return view('admin.produto.editproduto')->with(['produto' => Produto::find($request->idProduto)]);
    }

    public function post(Request $request){
        $request->validate([
            'nome' => 'max:100',
            'codBarras' => 'required|max:20',
            'valorUnit' => 'required',
        ],$this->messages());

        try{
            $produto = new Produto();
            $produto->NomeProduto = $request->nome;
            $produto->CodBarras = $request->codBarras;
            if(is_numeric(str_replace(',', '.', $request->valorUnit))){
                $produto->ValorUnitario = str_replace(',', '.', $request->valorUnit);
            }else{
                return view('erros.500')->with(['mensagem' => $e]);
            }
            $produto->save();
            return view('admin.produto.editproduto')->with(['produto' => $produto, 'sucesso' => true]);
        }catch(Exception $e){
            return view('erros.500')->with(['mensagem' => $e]);
        }
    }
    public function put(Request $request){
        $request->validate([
            'nome' => 'max:100',
            'codBarras' => 'required|max:20',
            'valorUnit' => 'required',
        ],$this->messages());

        try{
            $produto = Produto::find($request->idProduto);
            $produto->NomeProduto = $request->nome;
            $produto->CodBarras = $request->codBarras;
            if(is_numeric(str_replace(',', '.', $request->valorUnit))){
                $produto->ValorUnitario = str_replace(',', '.', $request->valorUnit);
            }else{
                return view('erros.500')->with(['mensagem' => $e]);
            }
            $produto->save();
            return view('admin.produto.editproduto')->with(['produto' => $produto, 'sucesso' => true]);
        }catch(Exception $e){
            return view('erros.500')->with(['mensagem' => $e]);
        }
    }

    public function delete(Request $request){
        try{
            $produto = Produto::find($request->idProduto);
            if(count($produto->pedidos) > 0){
                return view('admin.produto.editproduto')->with(['produto' => $produto, 'erro' => 'Este produto contém pedidos']);
            }else{
                $produto->delete();
                return view('admin.produto.index')->with(['produtos' => Produto::orderby('NomeProduto', 'ASC')->paginate(20), 'sucesso' => true]);
            }
        }catch(Exception $e){
            return view('erros.500')->with(['mensagem' => $e]);
        }
    }

    public function get(){
        return response()->json(['response' => 'success', 'produtos' => Produto::get()]);
    }

    public function search(Request $request){
        switch ($request->tipo) {
            case 'nome':
                return view('admin.produto.index')->with(['produtos' => Produto::where('NomeProduto', 'LIKE', $request->texto."%" )->paginate(20)]);
            case 'codBarras':
                return view('admin.produto.index')->with(['produtos' => Produto::where('CodBarras', 'LIKE', $request->texto."%" )->paginate(20)]);
            case 'valor':
                return view('admin.produto.index')->with(['produtos' => Produto::where('ValorUnitario', '=', $request->texto."%" )->paginate(20)]);
        }
    }

    public function order(Request $request){
        switch ($request->ordem) {
            case 'nome':
                return view('admin.produto.index')->with(['produtos' => Produto::orderBy('NomeProduto', 'ASC')->paginate(20), 'ordemNome' => true]);
            case 'codBarras':
                return view('admin.produto.index')->with(['produtos' => Produto::orderBy('CodBarras', 'ASC')->paginate(20), 'ordemCod' => true]);
            case 'valor':
                return view('admin.produto.index')->with(['produtos' => Produto::orderBy('ValorUnitario', 'ASC')->paginate(20) , 'ordemValor' => true]);
        }
    }

    private function messages(){
        return [
            'nome.max' => 'Máximo 100 caracteres',
            'codBarras.required'  => 'Campo Código de barras obrigatório',
            'codBarras.max'  => 'Máximo 11 caracteres',
            'valorUnit.required'  => 'Valor Unit. é obrigatório',
        ];
    }
}
