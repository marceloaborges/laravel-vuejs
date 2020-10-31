@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-8 col-md-7 col-lg-4 divLogin">
            <div class="text-center">
                <img class="img-fluid" src="{{url('assets/geral/img/connectta.png')}}">
            </div>
                <form method="POST" action="{{ route('login') }}">
                {{csrf_field()}}                
                @if($errors->all())
                    <p class="login-error">
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </p>
                @endif
                <div class="form-group">                    
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Login">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>             

                <div class="form-group">                    
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Senha" value="12345678">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">                    
                    <input id="verificador" type="password" class="form-control @error('verificador') is-invalid @enderror" name="verificador" value="IT**01" {{-- value="{{ old('verificador') }}" --}} required placeholder="Código Verificador">
                    @error('verificador')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="text-right">
                        <button type="submit" class="btn btn-block btn-primary">
                            <i class="fas fa-unlock-alt"></i> Acessar
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
