<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
	<title>{{ config('app.name', 'Foot-score') }}  @yield('title')</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<body>
	<div id="button-up"></div>
	
	<!-- Шапка -->
	<div class="container-lg">
		<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
			<a href="{{ route('index') }}" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
				<span class="btn btn-success me-2">FootScore</span>
			</a>
		
			<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
				@if (Auth::check() && Auth::user()->is_admin == 1)
					<li><a href="{{ route('admin.users.index') }}" class="nav-link px-2 link-dark">Admin</a></li>
				@endif
			</ul>
		
			<div class="col-md-3 text-end">
				@if (Route::has('login'))
				<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
					@auth
						<a href="{{ route('profile') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">My Profile</a>
					@else
						<a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

						@if (Route::has('register'))
							<a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
						@endif
					@endauth
				</div>
			@endif

			</div>
		</header>
	</div>

	<!-- Основной контент -->
	<div class="main">
		<div class="container-lg">
				<div class="row flex-nowrap">
					<!-- Sidebar Menu -->
						@include('includes.sidebar')
					<!-- /.sidebar-menu -->
					
					<!-- Main content -->
						<main class="col ps-md-2 pt-2">
							<a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="border rounded-3 p-1 text-decoration-none text-black sidebar-none">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list mb-1" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
								</svg> Menu
							</a>
							@yield('content')
						</main>
					<!-- /.main content -->
				</div>
		</div>
	</div>
	

	<!-- Футер -->
	<div class="container-lg">
		<footer class="footer mt-0">
			<p class="text-center text-muted">&copy; <span id="year"></span> {{ config('app.name', 'Laravel') }}, Inc</p>
		</footer>
	</div>
	<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="{{ asset('js/base.js') }}"></script>
	@yield('js')
	@yield('main_js')
</body>
</html>