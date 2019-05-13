<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Candidata;

class CandidataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // obtém os registros cadastrados na tabela candidatas
        $linhas = Candidata::orderBy('nome')->get();

        return view('lista_candidatas', ['linhas' => $linhas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form_candidatas', ['acao'=>1]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // obtém todos os campos do formulário
        $dados = $request->all();

        // armazena a foto em public/storage/fotos
        $path = $request->file('imagem')->store('fotos', 'public');

        // obtém o caminho da foto
        $dados['foto'] = $path; 

        // insere o registro (com as definições do fillable (na Model) e com os 
        // nomes de campos do formulário idênticos ao da tabela)
        $reg = Candidata::create($dados);

        if ($reg) {
            return redirect()->route('candidatas.index')
                   ->with('status', 'Ok! Candidata Inserida com Sucesso');
        } else {
            return redirect()->route('candidatas.index')
                   ->with('status', 'Erro... Candidata Não Inserida...');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // procura (e posiciona) no registro cujo id foi passado como parâmetro
        $reg = Candidata::find($id);

        return view('form_candidatas', ['reg' => $reg, 'acao' => 3]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // procura (e posiciona) no registro cujo id foi passado como parâmetro
        $reg = Candidata::find($id);

        return view('form_candidatas', ['reg' => $reg, 'acao' => 2]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // obtém os campos do form
        $dados = $request->all();

        // posiciona no registro a ser alterado
        $reg = Candidata::find($id);

        // se alterou a foto... realiza a alteração da foto
        if (isset($dados['imagem'])) {
          // armazena a foto em public/storage/fotos
          $path = $request->file('imagem')->store('fotos', 'public');

          // obtém o caminho da foto
          $dados['foto'] = $path; 

          // obtém o caminho da foto antiga
          $antiga = $reg->foto;
          // exclui a foto antiga
          Storage::disk('public')->delete($antiga);  
        }

        // altera o registro com os novos dados do form
        $alt = $reg->update($dados);

        if ($alt) {
            return redirect()->route('candidatas.index')
                   ->with('status', 'Ok! Candidata Alterada com Sucesso');
        } else {
            return redirect()->route('candidatas.index')
                   ->with('status', 'Erro... Candidata Não Alterada...');
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // posiciona no registro a ser excluído
        $reg = Candidata::find($id);

        // obtém o caminho da foto
        $foto = $reg->foto;
        // exclui a foto 
        Storage::disk('public')->delete($foto);  

        if ($reg->delete()) {
            return redirect()->route('candidatas.index')
                   ->with('status', 'Ok! Candidata Excluída com Sucesso');
        } else {
            return redirect()->route('candidatas.index')
                   ->with('status', 'Erro... Candidata Não Excluída...');
        }
    }
}
