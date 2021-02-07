<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\CompraPedido;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprasController extends Controller
{
    public function create()
    {
        $produtos = Produto::all();
        $clientes = Cliente::all();
        $users    = User::all();

        return view('admin.create.compra', [
            'produtos' => $produtos,
            'clientes' => $clientes,
            'users'    => $users
        ]);
    }

    public function store(Request $request)
    {
        try {
            $compra = new Compra();
            $compra->dataDaCompra = date('Y-m-d');
            $compra->dataDeEntrega = $request->dataDeEntrega;
            $compra->dataDePagamento = $request->dataDePagamento;
            $compra->formaDePagamento = $request->formaDePagamento;
            $compra->financiamento = $request->financiamento;
            $compra->cliente_id = $request->cliente_id;
            $compra->user_id = 1;
            $compra->pagamentoParcela = date('Y-m-d');
            $compra->valorFinal = $request->totalvalueback;
            $compra->status = 'Compra realizada';
            $compra->save();
        } catch (\Exception $e) {
            return redirect('/create-compra')->with([ 'response' => 'Preencha todos os dados corretamente' ]);
        }

        $ultimaCompra = DB::table('compra')->select('id')->orderBy('created_at', 'desc')->first();
        $selectedProducts = explode("//", $request->selectedProducts);
        array_pop($selectedProducts);

        try {
            foreach($selectedProducts as $product) {
                $product = explode('&', $product);
                $idStr = (explode('=', $product[1]));
                $id = (int)$idStr[1];
                $quantidadeExistente = DB::table('produtos')->select('quantidade')->where('id', '=', $id)->first();
                $quantidadeStr = explode('=', $product[0]);
                $quantidade = (int)$quantidadeStr[1];
                if($quantidadeExistente->quantidade - $quantidade <= 0) {
                    return redirect('/create-compra')->with([ 'response' => 'Quantidade indisponivel, disponível: ' . $quantidadeExistente->quantidade ]);
                }

                DB::table('produtos')->where('id', '=', $id)->decrement('quantidade', $quantidade);
                $comprapedido = new CompraPedido();
                $comprapedido->compra_id = (int)$ultimaCompra->id;
                $comprapedido->produto_id = $id;
                $comprapedido->save();
            }
        } catch (\Exception $e) {
            return redirect('/create-compra')->with([ 'response' => 'CHAMA O PAULO QUE DEU ERRO NO FOREACH' ]);

        }
        return redirect('/create-compra')->with([ 'response' => 'Cadastrado compra com sucesso!' ]);
    }

    public function getClientesForIndex()
    {
        // financiamento !== null && mes de pagamento +  parcelas de financiamento !== do mes atual &&
        $pagarHoje = DB::table('compra')->select('*')->where('financiamento', '!=', null)->whereDay('dataDePagamento', '=', date('d'))->get();
        $pagarHojeCorrect = array();
        foreach ($pagarHoje as $pagar) {
            $DataInicial = getdate(strtotime(date('Y-m-d')));
            $DataFinal = getdate(strtotime($pagar->pagamentoParcela));
            $Dif = ($DataInicial[0] - $DataFinal[0]) / 86400;
            $meses = round($Dif/30);

            if($pagar->financiamento - $meses >= 0 && explode('-', $pagar->pagamentoParcela)[2] - explode('-', $pagar->dataDePagamento)[2] !== -1 ) {
                $pagarHojeCorrect[] = $pagar;
            }
        }
        $atrasados = DB::table('compra')->select('*')
            ->where('financiamento', '!=', null)
            ->where('pagamentoParcela', '!=', null)
            ->where('dataDePagamento', '!=', null)
            ->get();
//        ->where('dataDePagamento', '<', function ($query) {
//        $query->selectRaw('pagamentoParcela')->from('compra');
//    }
        $atrasadosCorrect = array();
        foreach ($atrasados as $atrasado) {
            if(strtotime($atrasado->pagamentoParcela) > strtotime($atrasado->dataDePagamento)) {
                $atrasadosCorrect[] = $atrasado;
            }
        }

        return view('admin.index', [
            'pagarHoje' => $pagarHojeCorrect,
            'atrasados' => $atrasadosCorrect,
        ]);
    }

    public function faturamento()
    {

        $valorTotalDB = DB::table('compra')->select('valorFinal')->whereMonth('dataDaCompra', '=', date('m'))->get();
        $valorTotalMes = 0;
        $graphValorPorMes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $graphVendasPorMes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $comprasBeto = DB::table('compra')->select('valorFinal')->where('user_id', 1)->whereMonth('dataDaCompra', '=', date('m'))->get();
        $comprasLais = DB::table('compra')->select('valorFinal')->where('user_id', 2)->whereMonth('dataDaCompra', '=', date('m'))->get();

        $valorTotalBeto = 0;
        foreach ($comprasBeto as $compra) {
            $valorTotalBeto += $compra->valorFinal;
        }
        $valorTotalLais = 0;
        foreach ($comprasLais as $compra) {
            $valorTotalLais += $compra->valorFinal;
        }

        for($i = 1; $i <= 12; $i++) {
            $valorTotalGraph = DB::table('compra')->select('valorFinal')->whereMonth('dataDaCompra', '=', $i)->get();
            $graphVendasPorMes[$i - 1] = DB::table('compra')->select('*')->whereMonth('dataDaCompra', '=', $i)->count();

            foreach ($valorTotalGraph as $value) {

                $graphValorPorMes[$i - 1] += $value->valorFinal;
            }
        }

        foreach ($valorTotalDB as $value) {

            $valorTotalMes += $value->valorFinal;
        }
        return view('admin.faturamento', [
            'valorTotalMes'     => $valorTotalMes,
            'graphValorPorMes'  => $graphValorPorMes,
            'graphVendasPorMes' => $graphVendasPorMes,
            'valorTotalBeto'    => $valorTotalBeto,
            'valorTotalLais'    => $valorTotalLais
        ]);
    }

    public function pagou($id)
    {
        try {
            $compra = Compra::find($id);
            $compra->pagamentoParcela = date('Y-m-d', strtotime('-1 days'));
            $compra->save();
            $response = "Pagamento cadastrado com sucesso! Caso ainda esteja na tabela reinicie a página!";
        } catch (\Exception $e) {

            $response = "Erro ao cadastrar pagamento, contate o Paulo Rievrs";
        }

        return redirect('/admin')->with(['response' => $response]);

    }

    public function pagouAtrasado($id)
    {
        try {
            $compra = Compra::find($id);
            $compra->pagamentoParcela = date($compra->dataDePagamento, strtotime('-1 days'));
            $compra->save();
            $response = "Pagamento cadastrado com sucesso! Caso ainda esteja na tabela reinicie a página!";
        } catch (\Exception $e) {
            $response = "Erro ao cadastrar pagamento, contate o Paulo Rievrs";
        }

        return redirect('/admin')->with(['response' => $response]);

    }
}
