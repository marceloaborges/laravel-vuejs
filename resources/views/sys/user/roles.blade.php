@extends('layouts.dashboardtemplate')

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					Perfis e Permissões
				</div>
				<div class="card-body">

					<div class="row">
						<div class="col-12">
							<form action="{{route('sys.users.roles.store', $user->id)}}" class="form" method="POST">
								@csrf
								<div class="form-row">
									<div class="form-group col-7 col-sm-9">
										<input type="text" name="filter" placeholder="Pesquisar" class="form-control" value="{{$filter['filter'] ?? ''}}">
									</div>
									<div class="form-group col-5 col-sm-3">
										<button type="submit" class="btn btn-light btn-block"><i class="fas fa-search"></i> Pesquisar</button>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-12 col-md-4">
										<label for="roles">Funções</label>
										<select id="roles" name="roles" class="form-control">
											<option selected>Choose...</option>
											@foreach( $user->roles as $role)
												<option value="{{$role->id}}">{{$role->name}}</option>
											@endforeach											
										</select>
									</div>
									<div class="form-group col-12 col-md-3">
										<label for="adicionar">Cadastrar</label>
										<button type="submit" name="adicionar" class="btn btn-light btn-block"><i class="fas fa-plux"></i> Adicionar Função</button>
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
										<th width="120px;">Ações</th>
										</tr>
									</thead>
									<tbody>
										@forelse( $user->roles as $role)									
											<tr>
												<td>{{ $role->name }}</td>
												<td>{{ $role->description }}</td>
												<td>
													<a href="{{route('sys.users.roles.index', $user->id)}}" class="btn btn-sm btn-info" title="Detalhes">
														<i class="fas fa-info-circle"></i>
													</a>
													<a href="#" class="btn btn-danger btn-sm actions" onclick='deletar("/sys/{{$user->id}}/roles/{{$role->id}}")'>
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
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							@if( isset($user->roles))
								<ul class="list-unstyled">
									@foreach($user->roles as $role)
										<li>
											<b>Perfil :</b> {{ $role->name }} <br/>
											<b>Descrição do Perfil:</b> {{ $role->description }}
										</li>
										@if( isset($role->permissions) )
											<ul class="list-unstyled">
												<b>Permissões</b>
												@foreach($role->permissions as $permission)

													<li>
														<li>
															{{ $permission->name }} ---- {{ $permission->description }}
														</li>
													</li>
												@endforeach
											</ul>											
										@endif
									@endforeach
								</ul>								
							@else
								<p>
									Nenhuma função cadastrada
								</p>
							@endif
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-12">
							<a href="{{ route('sys.users.edit',$user->id) }}" class="btn btn-sm btn-primary" title="Editar"><i class="far fa-edit"></i> Adicionar Permissão</a>
						</div>
					</div>

				</div>{{-- end card-body --}}
			</div>{{-- end card --}}
		</div>
	</div>

@endsection