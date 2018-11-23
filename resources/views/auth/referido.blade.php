@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.errors')
            <div class="card">
                <div class="card-header bg-secondary text-light">Date de alta y localiza tu Ayuper más cercano!</div>

                <div class="card-body">
                     <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Felicidades!</strong> por ser un cliente referido recibirás un 5% de Descuento en tu primer consumo
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <input type="hidden" value="2" name="estatus">
                        <input type="hidden" value="{{$user}}" name="referido">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text bg-warning show-pass"> <img src="{{ asset('img/eye-open.svg') }}" width="20px" alt=""> </div>
            </div>
            <input type="password" name="password" class=" pass form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" required>
          </div>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                               <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text bg-warning show-pass"> <img src="{{ asset('img/eye-open.svg') }}" width="20px" alt=""> </div>
            </div>
            <input type="password" name="password_confirmation" class="form-control pass" id="password_confirmation" required>
          </div>
                            </div>
                        </div>
                       

                        <div class="form-group row">
                            <div class="col-md-4">
                                
                            </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="politicas" id="politicas">
                              <label class="custom-control-label" for="politicas">He leído y acepto los Términos y Condiciones</label>
                            </div>
                        </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-warning text-light">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>


<script>
$(document).ready(function () {
   $('.show-pass').click(function () {
    if ($(this).parents('.input-group').find('.pass').attr('type') === 'text') {
     $(this).parents('.input-group').find('.pass').attr('type', 'password');
    } else {
     $(this).parents('.input-group').find('.pass').attr('type', 'text');
    }
   });
  });
</script>

@endsection