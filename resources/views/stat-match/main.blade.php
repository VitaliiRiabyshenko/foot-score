@extends('layouts.base')

@section('title', 'Home')

@section('content')

	<div id="fixtureData"></div>
	
	<div id="fixture_head"></div>
	
	<div id="buttons" class="d-flex flex-row bg-light border-start border-end text-uppercase">
	</div>

	<div id="fixture_main" class="border border-top-0 b-b-r">
	</div>

	<!-- 979139 -->
	<script>
		function getFixtureId() {
			let fixture_id = {{ $fixture_id }};
			return fixture_id;
		}
	</script>
@endsection

@section('main_js')
	<script src="{{ asset('js/fixture.js') }}"></script>
@endsection