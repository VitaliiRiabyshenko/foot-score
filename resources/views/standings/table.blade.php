@extends('layouts.base')

@section('content')

<div>
	<div id="league_header" class="d-flex justify-content-lg-start border mt-2 b-t-r b-b-r"></div>
	<div class="mt-2">
		<a href="{{ route('results', ['country' => $country, 'league' => $league]) }}" class="btn btn-light">Results</a>
		<a href="{{ route('fixtures', ['country' => $country, 'league' => $league]) }}" class="btn btn-light">Fixtures</a>
		<button class="btn btn-success">Standings</button>
	</div>
	<div id="buttons"></div>
	<div id="standings"></div>
</div>

<script>
	function getFixtureData() {
		return {
			'league_id': {{ $id }},
			'season': {{ $year }},
			'type': "{{ $type }}"
		};
	}
</script>

@endsection

@section('main_js')
	<script src="{{ asset('js/standings.js') }}"></script>
@endsection