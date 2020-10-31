@extends('layouts.dashboardtemplate')

@section('content')	

	<div class="box">
		<div class="box-header">
			<i class="fas fa-bars"></i> Detalhes Teste
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-12">
					@if( isset($teste))
						<h3>Nome : {{ $teste->name }}</h3>						
						<p>Código : {{ $teste->id }}</p>						
						<p>Título : {{ $teste->title }}</p>
						<p>Descrição : {{ $teste->description }}</p>
						<p>Observação : {{ $teste->observation }}</p>
						<p>
							@if( isset($teste->created_at) )
								Data Cadastro : {{ $teste->created_at->format('d/m/Y - H:i:s') }}
							@endif
						</p>
						<p>
							@if( isset($teste->updated_at) )
								Data Atualização : {{ $teste->updated_at->format('d/m/Y - H:i:s') }}
							@endif
						</p>
						<p>
							Usuário responsável: {{ $teste->user->name }}
						</p>
					@else
						<p>
							Nenhum registro encontrado
						</p>
					@endif
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-12">
					<a href="{{ route('sys.testes.index') }}" class="btn btn-sm btn-light"><i class="fas fa-backward"></i> Voltar</a>
					@if( isset($teste->id) )
						<a href="{{ route('sys.testes.edit',$teste->id) }}" class="btn btn-sm btn-secondary" title="Editar"><i class="far fa-edit"></i> Editar</a>
					@endif
				</div>
			</div>
		</div>
	</div>

@endsection