<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>{{ config('app.name', 'Modelo de Projeto') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="noindex">
	
	{{-- Css geral bootstrap --}}
	<link rel="stylesheet" href="{{url('assets/geral/css/bootstrap.min.css')}}">
	{{-- Css font Awesome --}}
	<link rel="stylesheet" href="{{url('assets/geral/fontawesome/css/all.css')}}">
	{{-- dashboard css --}}
	<link rel="stylesheet" href="{{url('assets/sys/css/dashboard.css')}}">
	{{-- custom css --}}
	<link rel="stylesheet" href="{{url('assets/geral/css/style.css')}}">
	{{-- scrollbarcss --}}
	<link rel="stylesheet" href="{{url('assets/sys/css/mCustomScrollbar.min.css')}}">
	{{-- Icon --}}
	<link rel="icon" type="image/png" href="{{url('assets/geral/img/title.png')}}">	

	<script src="{{url('assets/geral/js/jquery.min.js')}}"></script>

	{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}	

</head>
<body>

	<div class="wrapper">

	    <!-- Sidebar  -->
	    <nav id="sidebar">

	        <div class="sidebar-header">
	            <a href="{{route('sys.dashboard')}}">
	            	<img src="{{url('assets/geral/img/connectta.jpg')}}">
	            </a>
	        </div>

	        <ul class="list-unstyled components">			
				{{-- <li class="{{ Route::is('sys') ? 'active' : null }}"> --}}
				<li class="{{ $active == 'home' ? 'active' : null }}">
				    <a href="{{route('sys.dashboard')}}">
				    	<i class="fas fa-home"></i> HOME
				    </a>
				</li>

				<li class="{{ $active == 'testes' ? 'active' : null }}">
				    <a href="{{route('sys.testes.index')}}">
				    	<i class="fas fa-user"></i> Teste
				    </a>
				</li>

				<li class="{{ $active == 'users' ? 'active' : null }}">
				    <a href="{{route('sys.users.index')}}">
				    	<i class="fas fa-user-friends"></i> USUÁRIOS
				    </a>
				</li>
				
	        	<li class="{{ $active == 'pedidos' ? 'active' : null }}">
	        	    <a href="#userMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
	        	    	<i class="fas fa-users-cog"></i> PEDIDOS
	        	    </a>
	        	    <ul class="collapse list-unstyled" id="userMenu">
	        	        <li>
	        	            <a href="{{route('sys.testes.index')}}"><i class="far fa-arrow-alt-circle-right"></i> Listar Pedidos</a>
	        	        </li>
	        	        <li>
	        	            <a href="{{route('sys.testes.create')}}"><i class="fas fa-hand-point-right"></i> Cadastrar Pedido</a>
	        	        </li>				        
	        	    </ul>
	        	</li>
	        	<li class="{{ $active == 'financeiro' ? 'active' : null }}">
	        	    <a href="#financeiroMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
	        	    	<i class="fas fa-hand-holding-usd"></i> FINANCEIRO
	        	    </a>
	        	    <ul class="collapse list-unstyled" id="financeiroMenu">
	        	    	<li>
	        	            <a href="{{route('sys.testes.create')}}"><i class="fas fa-smile-wink"></i> Contas a Receber</a>
	        	        </li>
	        	        <li>
	        	            <a href="{{route('sys.testes.index')}}"><i class="fas fa-sad-tear"></i> Contas a Pagar</a>
	        	        </li>	        	        				        
	        	    </ul>
	        	</li>
	        	<hr/>
	        	<li class="{{ $active == 'roles' ? 'active' : null }}">
	        	    <a href="#rolesMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
	        	    	<i class="fas fa-cogs"></i> CONFIGURAÇÕES
	        	    </a>
	        	    <ul class="collapse list-unstyled" id="rolesMenu">
	        	    	<li>
	        	            <a href="{{route('sys.roles.index')}}"><i class="fas fa-cog"></i> Permissões</a>
	        	        </li>	        	        				        
	        	    </ul>
	        	</li>
	        	<li class="">
	        		<a href="{{ route('logout') }}"
	        		   onclick="event.preventDefault();
	        		                 document.getElementById('logout-form').submit();">
	        		    <i class="fas fa-sign-out-alt"></i> SAIR
	        		</a>
	        		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	        		    @csrf
	        		</form>
	        	</li>
	        </ul>
	    </nav>
	    {{-- end sidebar --}}

	    <!-- Page Content  -->
	    <div id="content">

	        <nav class="navbar navbar-expand-lg">
	            <div class="container-fluid">
	                <button type="button" id="sidebarCollapse" class="btn btn-secondary">
	                    <i class="fas fa-exchange-alt"></i>
	                </button>
	                <button class="btn btn-secondary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	                    <i class="fas fa-align-justify"></i>
	                </button>

	                <div class="collapse navbar-collapse" id="navbarSupportedContent">
	                    <ul class="nav navbar-nav ml-auto">
							<li class="nav-item dropdown user-dash">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="user-name"><i class="fas fa-user"></i> {{ Auth::user()->name }}</span>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{route("sys.users.show",Auth::user()->id)}}">Meus Perfil</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('logout') }}"
									   onclick="event.preventDefault();
									                 document.getElementById('logout-form').submit();">
									    <i class="fas fa-sign-out-alt"></i> {{ __('Sair') }}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									    @csrf
									</form>
								</div>
							</li>
	                    </ul>
	                </div>
	            </div>
	        </nav>
	        {{-- end navbar --}}

	        <div id="app">
		        <div class="container-fluid">	        	
		        	@yield('content')

		        	<div class="errors-msg"></div>
		        	<div class="success-msg"></div>
		        	@if ( session('status') )
	        			@include('layouts.alerts')
	        		@endif	        		        	
		        </div>
	        </div>

	    </div>
		{{-- end content --}}

	</div>
	{{-- end wrapper --}}


	<!-- Delete Modal -->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Excluir</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        	<p class="text-center">
	        		<b>Confirma Exclusão do Registro ?</b>
	        	</p>
	        	<input type="hidden" class="token" value="{{csrf_token()}}">
	        	<input type="hidden" id="urlDeletar" value="">
	        	<div class="preloader text-center">
	        		<img src="{{url('assets/sys/img/loader.gif')}}">
	        		<p>
	        			Excluindo Registro...
	        		</p>
	        	</div>	        
	      </div>
	      <div class="modal-footer">
		        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-backward"></i> Voltar</button>
		        <button type="button" class="btn btn-danger btn-confirm-delete"><i class="far fa-trash-alt"></i> Exluir</button>
	      </div>	      
	    </div>
	  </div>
	</div>


	<script>

		function deletar(urlDeletar)
		{
			jQuery("#urlDeletar").val(urlDeletar);
			jQuery("#deleteModal").modal("show");
		}		

		$(document).ready(function() {
		  	if($(".alert-success").length){
		  		jQuery(".alert-success").fadeOut(6000);
		  	}
		});		

		$(function(){

			/* Ação executadoa */
			jQuery(".btn-confirm-delete").click(function(){

				//Pegando url delete
				var deletar = jQuery("#urlDeletar").val();

				//Pegando valor csrf_field()
				var  csrf = jQuery(".token").val();

				jQuery.ajax({
					url: deletar,
					method: 'DELETE',
					data: {'_token': csrf},
					beforeSend: preloader(),
				})
				.done(function(data){
					if(data == "1"){
						jQuery(".success-msg").html('Registro excluído com sucesso !');
						jQuery(".success-msg").show();				
						jQuery(".success-msg").fadeOut(5000);
						setTimeout(closeDeleteModal, 1500);
						reload();		
					}else{
						jQuery(".errors-msg").html(data);
						jQuery(".errors-msg").show();
						jQuery(".errors-msg").fadeOut(5000);
						setTimeout(closeDeleteModal, 1500);	
					}
				})
				.fail(function(){
					jQuery(".errors-msg").html('Erro ao excluir registro');
					jQuery(".errors-msg").show();
					jQuery(".errors-msg").fadeOut(5000);
					setTimeout(closeDeleteModal, 1500);
				})
				.always(function(){
					setTimeout(endPreloader, 1500);
				});
				function preloader()
				{
					jQuery(".preloader").show();
				}
				function endPreloader()
				{
					jQuery(".preloader").hide();
				}
				function reload()
				{
					setTimeout("location.reload()", 4000);
				}
				function closeDeleteModal()
				{
					jQuery("#deleteModal").modal("hide");
				}
			});
		});

	</script>
	
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	
	<script src="{{url('assets/geral/js/popper.min.js')}}"></script>
	<script src="{{url('assets/geral/js/bootstrap.min.js')}}"></script>	
	<script src="{{url('assets/sys/js/mCustomScrollbar.min.js')}}"></script>
	<script src="{{url('assets/sys/js/dashboard.js')}}"></script>
	<script src="{{url('assets/geral/js/alert.js')}}"></script>

	



</body>
</html>