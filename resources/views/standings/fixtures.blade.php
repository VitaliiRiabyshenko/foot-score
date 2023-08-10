@extends('layouts.base')

@section('content')

<div>
	<div id="league_header" class="d-flex justify-content-lg-start border mt-2 b-t-r b-b-r"></div>
	<div class="mt-2 mb-2" id="btns">
		<a href="{{ route('results', ['country' => $country, 'league' => $league]) }}" class="btn btn-light">Results</a>
		<button class="btn btn-success">Fixtures</button>
		@if ($standings !== 0)
			<a href="{{ route('standings.index', ['country' => $country, 'league' => $league]) }}" class="btn btn-light">Standings</a>
		@endif
	</div>
	<div id="fixtures" class="mt-2"></div>
</div>

<script>
	function getFixtureData() {
		return {
			'league_id': {{ $id }},
			'season': {{ $year }}
		};
	}
</script>

@endsection

@section('main_js')
	<script src="{{ asset('js/fixtures_by_league.js') }}"></script>
	<script>
		getFixtures('fixtures');
	</script>	
@endsection