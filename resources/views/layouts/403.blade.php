@extends('layouts.dashboardtemplate')

@section('content')	
	
	<div class="row">
		<div class="col-12 col-md-8 col-lg-5">
			<div class="card">
				<div class="card-header text-white bg-danger">
					<b>Error</b>
				</div>
				<div class="card-body">
					<h3>Atenção !</h3>
					<h4>Você não tem autorização para acessar este recurso</h4>									
					<a class="btn btn-light" href="{{route('sys.dashboard')}}"><i class="fas fa-backward"></i> Voltar</a>
				</div>
			</div>
		</div>
	</div>

@endsection