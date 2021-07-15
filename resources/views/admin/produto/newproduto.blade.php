@extends('layouts.app')

@section('content')
<div class="container div-pai">
    <div class="mt-5">
        <div class="col-12 col-md-12">

            <div class="col-12">
                <a href="{{url('/')}}/produtos"><button class="btn btn-primary mb-2" type="button">Voltar</button></a>
            </div>
            <div class="col-12 col-md-6 offset-md-3">
                <h3>Novo Produto</h3>
                <hr>
            </div>

            <div class="col-12 col-md-6 offset-md-3 pb-5">
                <form action="{{url('/')}}/produto/post" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input class="form-control" type="text" id="nome" name="nome" value="{{ old('nome') }}">
                        @error('nome')<span class="mensagem-erro">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="codBarras">Código de Barras*</label>
                        <input class="form-control" type="text" id="codBarras" name="codBarras" value="{{ old('codBarras') }}">
                        @error('codBarras')<span class="mensagem-erro">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="valorUnit">Valor Unitário</label>
                        <input class="form-control money" type="text" id="valorUnit" name="valorUnit" value="{{ old('valorUnit') }}">
                        @error('valorUnit')<span class="mensagem-erro">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12 text-right p-0">
                        <button class="btn btn-success">Salvar</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection
