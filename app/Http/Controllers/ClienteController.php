<?php

namespace App\Http\Controllers;

use App\Cliente;
use Exception;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(){
        return view('admin.cliente.index')->with(['clientes' => Cliente::orderBy('NomeCliente','ASC')->paginate(20)]);
    }
    public function new(){
        return view('admin.cliente.newcliente');
    }
    public function edit(Request $request){
        return view('admin.cliente.editcliente')->with(['cliente' => Cliente::find($request->idCliente)]);
    }

    public function post(Request $request){
        $request->validate([
            'nome' => 'required|max:100',
            'cpf' => 'required|max:11|min:11',
            'email' => 'max:10',
        ],$this->messages());

        try{
            $cliente = new Cliente();
            $cliente->NomeCliente = $request->nome;
            $cliente->CPF = $request->cpf;
            if(!empty($request->email)){
                $cliente->Email = $request->email;
            }
            $cliente->save();
            return view('admin.cliente.editcliente')->with(['cliente' => $cliente]);
        }catch(Exception $e){
            return view('erros.500')->with(['mensagem' => $e]);
        }
    }
    public function put(Request $request){
        $request->validate([
            'nome' => 'required|max:100',
            'cpf' => 'required|max:11|min:11',
            'email' => 'max:10',
        ],$this->messages());

        try{
            $cliente = Cliente::find($request->idCliente);
            $cliente->NomeCliente = $request->nome;
            $cliente->Cpf = $request->cpf;
            if(!empty($request->email)){
                $cliente->Email = $request->email;
            }
            $cliente->save();
            return view('admin.cliente.editcliente')->with(['cliente' => Cliente::find($request->idCliente), 'sucesso' => true]);
        }catch(Exception $e){
            return view('erros.500')->with(['mensagem' => $e]);
        }
    }

    public function delete(Request $request){
        try{
            $cliente = Cliente::find($request->idCliente);
            if(count($cliente->pedidos) > 0){
                return view('admin.cliente.editcliente')->with(['cliente' => Cliente::find($request->idCliente), 'erro' => "Este cliente possui pedidos!"]);
            }else{
                $cliente->delete();
                return view('admin.cliente.index')->with(['clientes' => Cliente::orderby('NomeCliente', 'ASC')->paginate(20), 'sucesso' => true]);
            }
        }catch(Exception $e){
            return view('erros.500')->with(['mensagem' => $e]);
        }
    }

    public function get(){
        return response()->json(['response' => 'success', 'clientes' => Cliente::get()]);
    }

    public function search(Request $request){
        switch ($request->tipo) {
            case 'nome':
                return view('admin.cliente.index')->with(['clientes' => Cliente::where('NomeCliente', 'LIKE', $request->texto."%" )->paginate(20)]);
            case 'cpf':
                return view('admin.cliente.index')->with(['clientes' => Cliente::where('CPF', 'LIKE', $request->texto."%" )->paginate(20)]);
            case 'email':
                return view('admin.cliente.index')->with(['clientes' => Cliente::where('Email', 'LIKE', $request->texto."%" )->paginate(20)]);
        }
    }

    public function order(Request $request){
        switch ($request->ordem) {
            case 'nome':
                return view('admin.cliente.index')->with(['clientes' => Cliente::orderBy('NomeCliente', 'ASC')->paginate(20), 'ordemNome' => true]);
            case 'cpf':
                return view('admin.cliente.index')->with(['clientes' => Cliente::orderBy('CPF', 'ASC')->paginate(20), 'ordemCpf' => true]);
            case 'email':
                return view('admin.cliente.index')->with(['clientes' => Cliente::orderBy('Email', 'ASC')->paginate(20) , 'ordemEmail' => true]);
        }
    }

    private function messages(){
        return [
            'nome.required' => 'Campo nome obrigatório',
            'nome.max' => 'Máximo 100 caracteres',
            'cpf.required'  => 'Campo CPF obrigatório',
            'cpf.max'  => 'Máximo 11 caracteres',
            'cpf.min'  => 'CPF inválido',
            'email.max'  => 'Máximo 10 caracteres',
        ];
    }
}
