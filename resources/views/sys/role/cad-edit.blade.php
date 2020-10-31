@extends('layouts.dashboardtemplate')

@section('content')	


	<div class="card">
		<div class="card-header">
			@if( isset($role) )
				Atualizar Perfíl - <b>{{$role->name}}</b>
				<form action="{{route('sys.roles.update', $role->id)}}" method="POST">
					@method('PUT')					
			@else
				Cadastrar Perfíl
				<form action="{{route('sys.roles.store')}}" method="POST">
			@endif
		</div>
		<div class="card-body">
			{{-- {{csrf_field()}} --}}
			@csrf
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-8 col-lg-5">
					<label for="name">* Nome</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nome" maxlength="130" value="{{$role->name ?? old('name')}}" autofocus>
					@error('name')
					    <span class="invalid-feedback" role="alert">
					        <strong>{{ $message }}</strong>
					    </span>
					@enderror
				</div>
				<div class="form-group col-12">
					<label for="description">* Descrição</label>
					<input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Nome" maxlength="250" value="{{$role->description ?? old('description')}}" autofocus>
					@error('description')
					    <span class="invalid-feedback" role="alert">
					        <strong>{{ $message }}</strong>
					    </span>
					@enderror
				</div>							
			</div>									
			<a class="btn btn-danger" href="{{route('sys.roles.index')}}"><i class="fas fa-times"></i> Cancelar</a>
			<button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Salvar</button>
		</div>
	</div>

@endsection