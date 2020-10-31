@extends('layouts.dashboardtemplate')

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					Testes Cadastrados
				</div>
				<div class="card-body">

					<div class="row mb-3">
						<div class="col-12">
							<a class="btn btn-primary btn-sm" href="{{route('sys.testes.create')}}"><i class="fas fa-plus-circle"></i> Adicionar Teste</a>
						</div>
					</div>					
					<div class="table-responsive-lg">
						<table class="table table-borderless table-striped table-hover table-sm">
							<thead class="thead-light">
								<tr>
									<th>Id</th>
									<th>Nome</th>
									<th>Descrição</th>
									<th>Data Cadastro</th>
									<th>Data Atualização</th>
									<th>Responsável</th>
									<th width="120px;">Ações</th>
								</tr>
							</thead>
							<tbody>
								@forelse( $testes as $teste)					
									<tr>
										<td>{{$teste->id}}</td>
										<td>{{$teste->name}}</td>
										<td>{{$teste->descricao}}</td>
										<td>
											@if( isset($teste->created_at) )
												{{ $teste->created_at->format('d/m/Y - H:i:s') }}
											@endif
										</td>
										<td>
											@if( isset($teste->updated_at) )
												{{ $teste->updated_at->format('d/m/Y - H:i:s') }}
											@endif
										</td>
										<td>{{$teste->user->name}}</td>										
										<td>
											<a href="{{route('sys.testes.show', $teste->id)}}" class="btn btn-sm btn-info" title="Detalhes">
												<i class="fas fa-info-circle"></i>
											</a>
											<a href="{{route('sys.testes.edit', $teste->id)}}" class="btn btn-sm btn-secondary" title="Editar">
												<i class="far fa-edit"></i>
											</a>
											<a href="#" class="btn btn-danger btn-sm actions" onclick='deletar("/sys/testes/{{$teste->id}}")'>
												<i class="far fa-trash-alt"></i>
											</a>		      	
										</td>										
									</tr>
								@empty
								<tr>
									<td colspan="7">Nenhum registro encontrado</td>
								</tr>
								@endforelse
							</tbody>
						</table>
						<nav>
							@if( isset($filter) )
								{!! $testes->appends($filter)->links() !!}
							@else
								{{ $testes->links() }}
							@endif
						</nav>			
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection