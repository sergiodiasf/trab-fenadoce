@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">

@foreach($candidatas as $candidata)
<div class="col-md-3">
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="{{asset('alexis.jpg')}}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{$candidata->nome}}</h5>
    <p class="card-text">{{$candidata->clube}}</p>
    <a href="{{  route('voto-candidata', $candidata->id) }}" class="btn btn-primary">Votar nesta candidata</a>
  </div>
</div>
</div>
@endforeach
</div>
</div>


@endsection