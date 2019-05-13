@extends('modelo') 
@section('conteudo')

<div class="row">
  <div class="col-sm-10">
     <h3>Candidatas Cadastradas</h3>
  </div>   
  <div class="col-sm-2">
    <a href="{{ route('candidatas.create') }}" class="btn btn-primary btn-sm" style="margin-top:24px" role="button">Incluir</a>
  </div>   
</div>

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

<table class="table table-hover">
  <thead>
    <tr>
      <th>Nº</th>
      <th>Nome da Candidata</th>
      <th>Clube</th>
      <th>Foto</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($linhas as $linha)
    <tr>
      <td> {{ $linha->id }} </td>
      <td> {{ $linha->nome }} </td>
      <td> {{ $linha->clube }} </td>
      <td> <img src='storage/{{ $linha->foto }}' style='width: 120px; height: 80px;'> </td>
      <td> <a href="{{ route('candidatas.edit', $linha->id) }}" class="btn btn-info btn-sm" role="button">Alterar</a>&nbsp;
        <a href="{{ route('candidatas.show', $linha->id) }}" class="btn btn-success btn-sm" role="button">Consultar</a>&nbsp;
        <form method="post" action="{{ route('candidatas.destroy', $linha->id)}}" style="display: inline-block" onsubmit="return confirm('Confirma Exclusão desta Candidata?')">          
          {{ method_field('delete') }}
          {{ csrf_field() }}
          <input type="submit" class="btn btn-danger btn-sm" value="Excluir">
        </form>
      </td>
    </tr>

    @endforeach

  </tbody>
</table>
@endsection