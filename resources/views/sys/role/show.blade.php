@extends('layouts.dashboardtemplate')

@section('content')	
	
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					@if( isset($role) )
						Perfil {{ $role->name }}
					@endif
				</div>
				<div class="card-body">

					<div class="row">
						<div class="col-12">
							@if( isset($role))
								<h3>Perfil: {{ $role->name }}</h3>
								<p>Código : {{ $role->id }}</p>
								<p>Descrição : {{ $role->description }}</p>
								@if( isset($role->created_at) )
									<p>Data Cadastro : {{ $role->created_at->format('d/m/Y - H:i:s') }}</p>
								@endif
								@if( isset( $role->updated_at) )
									<p>Data Atualização : {{ $role->updated_at->format('d/m/Y - H:i:s') }}</p>
								@endif
							@else
								<p>
									Nenhum registro encontrado
								</p>
							@endif
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-12">
							<a href="{{ route('sys.roles.index') }}" class="btn btn-sm btn-light"><i class="fas fa-backward"></i> Voltar</a>
							@if( isset($role->id) )
								<a href="{{ route('sys.roles.edit',$role->id) }}" class="btn btn-sm btn-secondary" title="Editar"><i class="far fa-edit"></i> Editar</a>
							@endif
						</div>
					</div>

				</div>{{-- end card-body --}}
			</div>{{-- end card --}}
		</div>
	</div>{{-- end row --}}

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					Permissões {{ $role->name }}
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<form action="{{route('sys.roles.permissions.store', $role->id)}}" class="form" method="POST">
								@csrf
								<div class="form-row">
									<div class="form-group col-12 col-md-9">
										<select name="permission_id" class="form-control" required>
											<option selected value="">Selecionar nova permissão</option>
											@foreach( $permissions as $permission)
												<option value="{{ $permission->id }}">{{ $permission->name }} --- {{ $permission->description }}</option>
											@endforeach											
										</select>
									</div>
									<div class="form-group col-12 col-md-3">
										<button type="submit" name="adicionar" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Adicionar</button>
									</div>
								</div>
							</form>
						</div>	
					</div>

					<div class="row mt-3">
						<div class="col-12">
							<div class="table">
								<table class="table table-borderless table-striped table-hover table-sm">
									<thead class="thead-light">
										<tr>
											<th>Permissão</th>
											<th>Descrição</th>
											<th class="text-center" width="80px;">Ações</th>
										</tr>
									</thead>
									<tbody>
										@forelse( $role->permissions as $permission)									
											<tr>
												<td>{{ $permission->name }}</td>
												<td>{{ $permission->description }}</td>
												<td class="text-center">													
													<form action="{{route('sys.roles.permissions.destroy', ['role_id' => $role->id, 'permission_id' => $permission->id])}}" method="POST">
														@method('DELETE')
														@csrf
														<button class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
													</form>
												</td>
											</tr>
										@empty
										<tr>
											<td colspan="7">Este perfil não possui nenhuma permissão cadastrada</td>
										</tr>
										@endforelse
									</tbody>
								</table>			
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>	
	</div>

@endsection