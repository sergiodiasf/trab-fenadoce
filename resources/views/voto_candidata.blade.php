@extends('layouts.app')

@section('content')
    <h3>Aqui vai uma imagem</h3>
    <h1>Candidata: {{ $reg->nome }}</h1>
    <h2>Clube: {{ $reg->clube }}</h2>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <form action="{{route('votar')}}" method="post" >
            {{ csrf_field() }}
            <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira seu nome">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">E-mail</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Insira seu e-mail">
    <small id="emailHelp" class="form-text text-muted">Este e-mail só podera votar uma unica vez</small>
  </div>

  <input type="hidden" class="form-control" name="candidata_id" value="{{ $reg->id }}">

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
            </div>
        </div>
    </div>
@endsection