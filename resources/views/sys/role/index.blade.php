@extends('layouts.dashboardtemplate')

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					Perfis do Sistema
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<form action="{{route('sys.roles.search')}}" class="form form-search" method="POST">
								@csrf
								<div class="form-row">
									<div class="form-group col-7 col-sm-9">
										<input type="text" name="filter" placeholder="Pesquisar" class="form-control" value="{{$filter['filter'] ?? ''}}">
									</div>
									<div class="form-group col-5 col-sm-3">
										<button type="submit" class="btn btn-light btn-block"><i class="fas fa-search"></i> Pesquisar</button>
									</div>
								</div>
							</form>
						</div>			
					</div>{{-- end row --}}

					<div class="row mb-3">
						<div class="col-12">
							<a class="btn btn-primary btn-sm" href="{{route('sys.roles.create')}}"><i class="fas fa-plus-circle"></i> Adicionar Perfil</a>
						</div>
					</div>					
					<div class="table-responsive-lg">
						<table class="table table-borderless table-striped table-hover table-sm">
							<thead class="thead-light">
							<tr>
								<th>Nome</th>
								<th>Descrição</th>
								<th width="120px;">Ações</th>
								</tr>
							</thead>
							<tbody>
								@forelse( $roles as $role)
									<tr>
										<td>{{$role->name}}</td>
										<td>{{$role->description}}</td>										
										<td>
											<a href="{{route('sys.roles.show', $role->id)}}" class="btn btn-sm btn-info" title="Detalhes">
												<i class="fas fa-info-circle"></i>
											</a>
											<a href="{{route('sys.roles.edit', $role->id)}}" class="btn btn-sm btn-secondary" title="Editar">
												<i class="far fa-edit"></i>
											</a>
											<a href="#" class="btn btn-danger btn-sm actions" title="Excluir" onclick='deletar("/sys/roles/{{$role->id}}")'>
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
								{!! $roles->appends($filter)->links() !!}
							@else
								{{ $roles->links() }}
							@endif
						</nav>				
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection