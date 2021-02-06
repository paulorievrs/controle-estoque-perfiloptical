@include('admin.includes.header')
@section('header')
@endsection
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
                <div class="col-md-12">
                    <div class="card stat-card">
                        <div class="card-body">
                            <h5 class="card-title">Seja bem-vindo!</h5>
                            <h2 class="float-right">Hoje é dia {{ date('d/m/Y') }}</h2>
                            <p>Utilze o menu ao lado!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pagantes de hoje - Dia {{ date('d/m/Y') }}</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Dividiu em</th>
                                        <th scope="col">Total da compra</th>
                                        <th scope="col">Parcelas</th>
                                        <th scope="col">Pagou</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pagarHoje as $compra)
                                        @php
                                            $cliente = \App\Models\Cliente::find($compra->cliente_id);
                                        @endphp
                                    <tr>
                                        <td>{{ $cliente->nome }}</td>
                                        <td>{{ $cliente->telefone }}</td>
                                        <td>{{ $compra->financiamento }}x</td>
                                        <td>R$ {{  number_format($compra->valorFinal, 2, ',', ' ')}}</td>
                                        <td>R$ {{ number_format($compra->valorFinal / $compra->financiamento, 2, ',', ' ') }}</td>
                                        <td>
                                            <form action="/cadastrarpagamento/{{ $compra->id }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button class="btn"><i class="material-icons" style="color: green">thumb_up</i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Atrasados</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Dividiu em</th>
                                        <th scope="col">Total da compra</th>
                                        <th scope="col">Parcelas</th>
                                        <th scope="col">Pagou</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($atrasados as $compra)
                                        @php
                                            $cliente = \App\Models\Cliente::find($compra->cliente_id);

                                        @endphp
                                        <tr>
                                            <td>{{ $cliente->nome }}</td>
                                            <td>{{ $cliente->telefone }}</td>
                                            <td>{{ $compra->financiamento }}x</td>
                                            <td>R$ {{  number_format($compra->valorFinal, 2, ',', ' ')}}</td>
                                            <td>R$ {{ number_format($compra->valorFinal / $compra->financiamento, 2, ',', ' ') }}</td>
                                            <td>
                                                <form action="/cadastrarpagamentoatrasado/{{ $compra->id }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button class="btn"><i class="material-icons" style="color: green">thumb_up</i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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
    <script src="lime/assets/assets/plugins/jquery/jquery-3.1.0.min.js"></script>
    <script src="lime/assets/assets/plugins/bootstrap/popper.min.js"></script>
    <script src="lime/assets/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="lime/assets/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="lime/assets/assets/plugins/chartjs/chart.min.js"></script>
    <script src="lime/assets/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="lime/assets/assets/plugins/toastr/toastr.min.js"></script>
    <script src="lime/assets/assets/js/lime.min.js"></script>
    <script src="lime/assets/assets/js/pages/dashboard.js"></script>
</body>
</html>
