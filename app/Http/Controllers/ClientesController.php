<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = DB::table('clientes')->select('*')->orderBy('name')->paginate(10);
        return view('admin.clientes', [ 'clientes' => $clientes ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create.cliente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $cliente = new Cliente();
            $cliente->nome = $request->nome;
            $cliente->endereco = $request->endereco;
            $cliente->cpf = $request->cpf;
            $cliente->email = $request->email;
            $cliente->telefone = $request->telefone;
            $cliente->medico = $request->medico;
            $cliente->grauolhodir = $request->grauolhodir;
            $cliente->grauolhoesq = $request->grauolhoesq;
            $cliente->adicao = $request->adicao;
            $cliente->DNP = $request->DNP;
            $cliente->ACO = $request->ACO;
            $cliente->save();

            $response = "Adicionado cliente com sucesso!";
        } catch (\Exception $e) {
            $response = "Deve preencher: nome e graus. Verifique o e-mail se está correto e se já não existe ou cliente com o mesmo CPF";
        }

        return redirect('/create-cliente')->with(['response' => $response ]);

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
        $cliente = Cliente::find($id);
        return view('admin.edit.cliente', ['cliente' => $cliente]);
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
            $cliente = Cliente::find($id);
            $cliente->nome = $request->nome;
            $cliente->endereco = $request->endereco;
            $cliente->cpf = $request->cpf;
            $cliente->email = $request->email;
            $cliente->telefone = $request->telefone;
            $cliente->medico = $request->medico;
            $cliente->grauolhodir = $request->grauolhodir;
            $cliente->grauolhoesq = $request->grauolhoesq;
            $cliente->adicao = $request->adicao;
            $cliente->DNP = $request->DNP;
            $cliente->ACO = $request->ACO;
            $cliente->save();

            $response = "Alterado cliente com sucesso!";
        } catch (\Exception $e) {
            $response = "Erro ao alterar cliente";
        }

        return redirect('/edit-cliente/' . $id)->with(['response' => $response]);
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
            Cliente::find($id)->delete();
            $response = "Deletado com sucesso";
        } catch (\Exception $e) {
            $response = 'Erro ao deletar';
        }

        return redirect('/admin-clientes')->with(['response' => $response]);
    }
}
