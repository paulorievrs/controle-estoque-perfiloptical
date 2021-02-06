<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = DB::table('produtos')->select('*')->paginate(10);
        return view('admin.produtos', [ 'produtos' => $produtos ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create.produto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $produto = new Produto();
            $produto->nome = $request->nome;
            $produto->descricao = $request->descricao;
            $produto->preco = $request->preco;
            $produto->quantidade = $request->quantidade;
            $produto->save();
            $response = "Criado produto com sucesso!";
        } catch (\Exception $e) {
            $response = "Erro ao criar produto!";
        }

        return redirect('/create-produto')->with(['response' => $response]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('admin.edit.produto', [ 'produto' => $produto ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        try {

            $produto = Produto::find($id);
            $produto->nome = $request->nome;
            $produto->descricao = $request->descricao;
            $produto->preco = $request->preco;
            $produto->quantidade = $request->quantidade;
            $produto->save();
            $response = "Alterado produto com sucesso!";
        } catch (\Exception $e) {
            $response = "Erro ao alterar produto!";
        }

        return redirect('/edit-produto/' . $id)->with(['response' => $response]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            Produto::find($id)->delete();
            $response = "Deletado produto com sucesso!";
        } catch (\Exception $e) {
            $response = "Erro ao deletar produto!";
        }
        return redirect('/admin-produto')->with(['response' => $response]);

    }
}
