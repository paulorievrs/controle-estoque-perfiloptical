@extends('admin.includes.header')
@section('header')
@endsection
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <a href="/" class="btn btn-outline-danger">
                                    {{ __('Voltar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
