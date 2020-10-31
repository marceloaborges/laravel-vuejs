@extends('layouts.dashboardtemplate')

@section('content')

	<div class="box">
		<div class="box-header">
			@if( isset($teste) )
				<i class="fas fa-edit"></i> Atualizar Teste - <b>{{$teste->name}}</b>
				<form action="{{route('sys.testes.update', $teste->id)}}" method="POST">
					@method('PUT')					
			@else
				<i class="fas fa-edit"></i> Cadastrar Teste
				<form action="{{route('sys.testes.store')}}" method="POST">
			@endif
		</div>
		<div class="box-body">
			{{-- {{csrf_field()}} --}}
			@csrf
			<div class="form-row">
				<div class="form-group col-12 col-md-6">
					<label for="name">* Nome</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nome" maxlength="130" value="{{$teste->name ?? old('name')}}" autofocus>
					@error('name')
					    <span class="invalid-feedback" role="alert">
					        <strong>{{ $message }}</strong>
					    </span>
					@enderror
				</div>
				<div class="form-group col-12 col-md-6">
					<label for="title">* Título</label>
					<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Título" maxlength="130" value="{{$teste->title ?? old('title')}}" autofocus>
					@error('title')
					    <span class="invalid-feedback" role="alert">
					        <strong>{{ $message }}</strong>
					    </span>
					@enderror
				</div>							
			</div>
			<div class="form-row">
				<div class="form-group col-12">
					<label for="description">* Descrição</label>
					<input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Descrição" maxlength="130" value="{{$teste->description ?? old('description')}}" autofocus>
					@error('description')
					    <span class="invalid-feedback" role="alert">
					        <strong>{{ $message }}</strong>
					    </span>
					@enderror
				</div>											
			</div>
			<div class="form-row">
				<div class="form-group col-12">
					<label for="observation">* Observação</label>
					<input type="text" class="form-control @error('observation') is-invalid @enderror" id="observation" name="observation" placeholder="Observação" maxlength="130" value="{{$teste->observation ?? old('observation')}}" autofocus>
					@error('observation')
					    <span class="invalid-feedback" role="alert">
					        <strong>{{ $message }}</strong>
					    </span>
					@enderror
				</div>
			</div>								
			<a class="btn btn-sm btn-light" href="{{route('sys.testes.index')}}"><i class="fas fa-backward"></i> Voltar</a>
			<button type="submit" class="btn btn-sm btn-primary"><i class="far fa-save"></i> Salvar</button>
		</div>
	</div>

@endsection