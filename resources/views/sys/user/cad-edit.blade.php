@extends('layouts.dashboardtemplate')

@section('content')	


	<div class="card">
		<div class="card-header">
			@if( isset($user) )
				Atualizar Usuário - <b>{{$user->name}}</b>
				<form action="{{route('sys.users.update', $user->id)}}" method="POST">
					@method('PUT')					
			@else
				Cadastrar Usuário
				<form action="{{route('sys.users.store')}}" method="POST">
			@endif
		</div>
		<div class="card-body">
			{{-- {{csrf_field()}} --}}
			@csrf
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-8 col-lg-5">
					<label for="name">* Nome</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nome" maxlength="130" value="{{$user->name ?? old('name')}}" required autofocus>
					@error('name')
					    <span class="invalid-feedback" role="alert">
					        <strong>{{ $message }}</strong>
					    </span>
					@enderror
				</div>								
			</div>
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-8 col-lg-5">
					<label for="email">* Email</label>
					<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required placeholder="meuemail@email.com" maxlength="200" value="{{$user->email ?? old('email')}}" >
					@error('email')
					    <span class="invalid-feedback" role="alert">
					        <strong>{{ $message }}</strong>
					    </span>
					@enderror
				</div>
			</div>
			<div class="form-row">				
				<div class="form-group col-sm-12 col-lg-3">
					<label for="password">* Senha</label>
					<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" maxlength="20" required>
					@error('password')
					    <span class="invalid-feedback" role="alert">
					        <strong>{{ $message }}</strong>
					    </span>
					@enderror
				</div>
				<div class="form-group col-sm-12 col-lg-3">
					<label for="password2">* Confirmar Senha</label>
					<input type="password" class="form-control @error('password2') is-invalid @enderror" id="password2" name="password2" maxlength="20" required>
					@error('password2')
					    <span class="invalid-feedback" role="alert">
					        <strong>{{ $message }}</strong>
					    </span>
					@enderror
				</div>
			</div>
			<div class="form-row">
			 	<div class="form-group">
					<div class="form-check m-2">
						@if( isset($user->active) && ($user->active == 1))
							<input class="form-check-input" type="checkbox" id="active" name="active" value="1" checked>
						@else
							<input class="form-check-input" type="checkbox" id="active" name="active" value="1">
						@endif
						<label class="form-check-label" for="active">
							Ativo
						</label>
					</div>
				</div>
			</div>										
			<a class="btn btn-danger" href="{{route('sys.users.index')}}"><i class="fas fa-times"></i> Cancelar</a>
			<button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Salvar</button>
		</div>
	</div>

@endsection