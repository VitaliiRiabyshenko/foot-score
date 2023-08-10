<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>
		<!-- CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		<link rel="stylesheet" href="{{ mix('css/app.css') }}">
		
		<!-- Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

		<!-- Scripts -->
		<script src="{{ asset('js/app.js') }}" defer></script>
	</head>
	<body class="font-sans antialiased">
		<div class="min-h-screen bg-gray-100">
			@include('layouts.navigation')

			<!-- Page Heading -->
			<header class="bg-white shadow">
				<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
					{{ $header }}
				</div>
			</header>

			<!-- Page Content -->
			<main>
				{{ $slot }}
			</main>
		</div>
		<!-- Футер -->
	<div class="container">
		<footer class="py-3 my-4 fixed-bottom">
			<p class="text-center text-muted">&copy; 2022 FootScore, Inc</p>
		</footer>
	</div>
	</body>
</html>
