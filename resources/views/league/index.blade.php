@extends('layouts.base')

@section('title', '| '.$country_nm)

@section('content')
	<div class="page-header pt-3">
		<h2 class="d-flex justify-content-center">{{ $country_nm }}</h2>
	</div>
	<div class="row">
		<div class="col-12">
			@foreach ($leagues as $league)
				<div class="btn btn-light d-flex flex-column p-2 m-2">
					<a href="{{ route('standings.index', ['country' => $country_nm, 'league' => $league->name]) }}" value="{{ $league->id }}" class="text-dark text-decoration-none">
						<img src="{{ $league['logo'] }}" height="30" class="mb-1">
						{{ $league['name'] }}
					</a>
				</div>
			@endforeach
		</div>
@endsection