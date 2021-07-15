@extends('layouts.app')

@section('content')
<div class="container div-pai">
    <div class="justify-content-center mt-5">
        <div class="col-12 text-center">
            <h2>Erro 500!</h2>
            <p>Contate o suporte!</p>
        </div>
        <div class="col-12 col-md-8 offset-md-2">
            {{$mensagem ?? ""}}
        </div>
    </div>
</div>
@endsection
