@if(Auth::user()->email !== 'betori3@gmail.com')
    <script>
        window.location.href='/admin';
    </script>
@endif

@include('admin.includes.header')
@section('header')
@endsection

<div class="lime-container">
    <div class="lime-body">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card stat-card">
                        <div class="card-body">
                            <h5 class="card-title">Faturamento do mês atual </h5>
                            <h2 class="float-right">R$ {{ $valorTotalMes }}</h2>
                            <p>{{ getBrazilianName((DateTime::createFromFormat('!m', date('m')))->format('F')) }}</p>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ (date('d') * 100) / 30 }}%" aria-valuenow="{{ date('d') }}" aria-valuemin="0" aria-valuemax="31"></div>
                            </div>
                            <small>Andamento do mês (dias) </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Faturamento do ano de {{ date('Y') }}</h5>
                            <div id="apex3"></div>
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
    <script src="lime/assets/assets/plugins/chartjs/chart.min.js"></script>
    <script>
        let options3 = {
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '50%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: [{
                name: 'Vendas',
                data: @php echo json_encode($graphVendasPorMes) @endphp
            }, {
                name: 'Valor Total',
                data: @php echo json_encode($graphValorPorMes) @endphp
            }],
            xaxis: {
                categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            },
            yaxis: {
                title: {
                    text: 'Vendas x Valores'
                }
            },
            fill: {
                opacity: 1

            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        }

        let chart3 = new ApexCharts(
            document.querySelector("#apex3"),
            options3
        );

        chart3.render();
    </script>
</body>
</html>
@php
    function getBrazilianName($name) {
        $months = [
            'January' => 'Janeiro',
            'February' => 'Fevereiro',
            'March' => 'Março',
            'April' => 'Abril',
            'May' => 'Maio',
            'June' => 'Junho',
            'July' => 'Julho',
            'August' => 'Agosto',
            'September' => 'Setembro',
            'October' => 'Outubro',
            'November' => 'Novembro',
            'December' => 'Dezembro',
        ];
        return $months[$name];

    }
@endphp
