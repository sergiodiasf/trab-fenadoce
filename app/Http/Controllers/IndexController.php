<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voto;
use App\Candidata;

class IndexController extends Controller
{
    public function listarCandidatas()
    {
        // obtém os registros cadastrados na tabela candidatas
        $candidatas = Candidata::orderBy('nome')->get();

        return view('index', ['candidatas' => $candidatas]);
    }

    public function showCandidata($id)
    {
        // procura (e posiciona) no registro cujo id foi passado como parâmetro
        $reg = Candidata::find($id);

        return view('voto_candidata', ['reg' => $reg]);
        
    }

    public function votar(Request $request)
    {
        // obtém todos os campos do formulário
        $dados = $request->all();

        // insere o registro (com as definições do fillable (na Model) e com os 
        // nomes de campos do formulário idênticos ao da tabela)
        $reg = Voto::create($dados);

        return redirect()->route('index.listar');
    }
}
