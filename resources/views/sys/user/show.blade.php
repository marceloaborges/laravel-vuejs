@extends('layouts.dashboardtemplate')

@section('content')	

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					@if( isset($user) )
						{{ $user->name }}
					@endif
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							@if( isset($user))
								<h3>Nome : {{ $user->name }}</h3>
								<p>Código : {{ $user->id }}</p>
								<p>Email : {{ $user->email }}</p>
								@if( isset($user->created_at) )
									<p>Data Cadastro : {{ $user->created_at->format('d/m/Y - H:i:s') }}</p>
								@endif
								@if( isset( $user->updated_at) )
									<p>Data Atualização : {{ $user->updated_at->format('d/m/Y - H:i:s') }}</p>
								@endif
								<p>
									Status :
									@if($user->active === 0)
										Inativo
									@else
										Ativo
									@endif
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
							<a href="{{ route('sys.users.index') }}" class="btn btn-sm btn-light"><i class="fas fa-backward"></i> Voltar</a>
							@if( isset($user->id) )
								<a href="{{ route('sys.users.edit',$user->id) }}" class="btn btn-sm btn-secondary" title="Editar"><i class="far fa-edit"></i> Editar</a>
							@endif
						</div>
					</div>
				</div>{{-- end card-body --}}
			</div>{{-- end card --}}
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					Perfil de {{ $user->name }}
				</div>
				<div class="card-body">

					<div class="row">
						<div class="col-12">
							<form action="{{route('sys.users.roles.store', $user->id)}}" class="form" method="POST">
								@csrf
								<div class="form-row">
									<div class="form-group col-12 col-md-9">
										<select name="role_id" class="form-control" required>
											<option selected value="">Selecionar novo Perfil</option>
											@foreach( $roles as $role)
												<option value="{{ $role->id }}">{{ $role->name }} --- {{ $role->description }}</option>
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

					<div class="row">
						<div class="col-12">
							<div class="table-responsive-lg">
								<table class="table table-borderless table-striped table-hover table-sm">
									<thead class="thead-light">
										<tr>
										<th>Função</th>
										<th>Descrição</th>
										<th class="text-center" width="120px;">Ações</th>
										</tr>
									</thead>
									<tbody>
										@forelse( $user->roles as $role)									
											<tr>
												<td>{{ $role->name }}</td>
												<td>{{ $role->description }}</td>
												<td class="text-center">													
													<form action="{{route('sys.users.roles.destroy', ['user_id' => $user->id, 'role_id' => $role->id])}}" method="POST">
														<a href="{{route('sys.roles.show', $role->id)}}" class="btn btn-sm btn-secondary" title="Editar">
															<i class="far fa-edit"></i>
														</a>
														@method('DELETE')
														@csrf
														<button class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
													</form>
												</td>
											</tr>
										@empty
											<tr>
												<td colspan="7">Este usuário não possui nenhum perfil cadastrado</td>
											</tr>
										@endforelse
									</tbody>
								</table>			
							</div>
						</div>
					</div>

				</div>{{-- end card-body --}}
			</div>{{-- end card --}}
		</div>
	</div>



@endsection