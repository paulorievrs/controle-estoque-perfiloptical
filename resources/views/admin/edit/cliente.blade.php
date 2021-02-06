@include('admin.edit.includes.header')
@section('limeheader')
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
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Editar um cliente</h5>
                            <form action="/cliente/{{ $cliente->id }}" method="POST">
                                @method('PUT')
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" class="form-control" name="nome" placeholder="Nome completo" value="{{ $cliente->nome }}" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" class="form-control" name="endereco" placeholder="Endereço" value="{{ $cliente->endereco }}" />
                                    </div>
                                </div>

                                <div class="form-row d-flex flex-row">
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" onkeydown="javascript: fMasc( this, mCPF );" class="form-control" name="cpf" placeholder="CPF" value="{{ $cliente->cpf }}"/>
                                    </div>

                                    <div class="col-md-6 form-group pb-2">
                                        <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ $cliente->email }}"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" class="form-control" name="telefone" onkeypress="maskphone(this, mphone);" placeholder="Telefone" value="{{ $cliente->telefone }}"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" class="form-control" name="medico" placeholder="Médico" value="{{ $cliente->medico }}" />
                                    </div>
                                </div>

                                <div class="form-row d-flex flex-row">
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" onkeypress="return onlynumber();" class="form-control" name="grauolhodir" placeholder="Grau olho direito" value="{{ $cliente->grauolhodir }}"/>
                                    </div>
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" onkeypress="return onlynumber();" class="form-control" name="grauolhoesq" placeholder="Grau olho esquerdo" value="{{ $cliente->grauolhoesq }}" />
                                    </div>
                                </div>

                                <div class="form-row d-flex flex-row">
                                    <div class="col-md-4 form-group pb-2">
                                        <input type="text" min="0" class="form-control" name="adicao" placeholder="Adição" value="{{ $cliente->adicao }}"/>
                                    </div>
                                    <div class="col-md-4 form-group pb-2">
                                        <input type="text" min="0" name="DNP" class="form-control" placeholder="DNP" value="{{ $cliente->DNP }}"/>
                                    </div>
                                    <div class="col-md-4 form-group pb-2">
                                        <input type="text" min="0" name="ACO" class="form-control" placeholder="ACO" value="{{ $cliente->ACO }}" />
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="submit" style="width: 1100px" class="btn btn-success">Editar um cliente</button>
                                </div>
                            </form>
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
</body>
</html>
