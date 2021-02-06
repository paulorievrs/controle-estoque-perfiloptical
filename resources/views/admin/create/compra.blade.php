@include('admin.includes.header')
@section('limeheader')
@endsection
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<div class="lime-container">
    <div class="lime-body">
        <div class="container">
            @if(session('response') !== null)
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-primary" role="alert">
                            {{ session('response') }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Criar uma compra</h5>
                            <form action="/compra" method="POST">

                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-6 form-group pb-2">
                                        <label>Data de entrega</label>
                                        <input type="date" class="form-control" name="dataDeEntrega" />
                                    </div>
                                    <div class="col-md-6 form-group pb-2">
                                        <label>Data de pagamento</label>
                                        <input type="date" class="form-control" name="dataDePagamento" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 form-group pb-2">
                                        <select class="selectpicker" data-width="100%" id="pagamento" onChange="changePayment()" name="formaDePagamento">
                                            <option selected>Qual a forma de pagamento?</option>
                                            <option value="Débito">Débito</option>
                                            <option value="Crédito">Crédito</option>
                                            <option value="Dinheiro">Dinheiro</option>
                                            <option value="Promissória">Promissória</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 form-group pb-2" id="financiamento" style="display: none">
                                        <input type="text" class="form-control" name="financiamento" placeholder="Parcelas da promissoria" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 form-group pb-2">
                                        <select class="selectpicker" data-width="100%" id="clientes" data-size="7" name="cliente_id" data-show-subtext="true" data-live-search="true">
                                            <option selected>Quem efetuou a compra?</option>
                                            @foreach($clientes as $cliente)
                                                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 form-group pb-2">
                                        <select class="selectpicker" data-width="100%" id="users" name="user_id">
                                            <option selected>Quem efetuou a venda?</option>
                                            <option value="1">Laís</option>
                                            <option value="2">Helbert</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 form-group pb-2" style="width: 100%;">
                                        <select class="selectpicker" data-width="100%" id="produtos" onChange="changePayment()" data-show-subtext="true" data-live-search="true">
                                            <option selected>Selecione produtos</option>
                                            @foreach($produtos as $produto)
                                                <option value={{ $produto->id }}>{{ $produto->nome }} | Quantidade: {{ $produto->quantidade }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @foreach($produtos as $produto)
                                        <input type="hidden" style="display: none" id="preco-{{ $produto->id }}" value="{{ $produto->preco }}">
                                    @endforeach
                                    <div class="col-md-4 form-group pb-2">
                                        <input type="number" class="form-control" style="height: 35px" id="quantidadeProduto" placeholder="Quantidade" />
                                    </div>
                                    <div class="col-md-2 form-group pb-2">
                                        <a style="width: 100%; cursor:pointer;" onclick="Adicionar()" class="btn btn-outline-info btnAdicionar">Registrar produto</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="produto" class="table">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Nome</th>
                                                            <th scope="col">Preço</th>
                                                            <th scope="col">Quantidade</th>
                                                            <th scope="col">Deletar</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                    <span id="totalValue">Valor total: </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="selectedProducts" name="selectedProducts"/>

                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="submit" style="width: 1100px" class="btn btn-primary">Registrar compra</button>
                                </div>
                            </form>
                            <small>Utilize '.' (ponto) para representar vírgula</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lime-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span class="footer-text">2021 © Perfil Optical</span>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Javascripts -->
<script src="/js/masks.js"></script>

<script src="/lime/assets/assets/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="/lime/assets/assets/plugins/bootstrap/popper.min.js"></script>
<script src="/lime/assets/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/lime/assets/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/lime/assets/assets/js/lime.min.js"></script>
<script src="/js/addProduct.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
</body>
</html>
