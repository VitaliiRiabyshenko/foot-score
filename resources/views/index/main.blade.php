@extends('layouts.base')

@section('title', '| Home')

@section('content')
	
		<!--<div class="d-flex justify-content-between">
			<nav class="navbar navbar-expand-sm">
				 Links 
				<ul class="navbar-nav">
					<li class="nav-item">
						<div class="nav-link cursor-pointer" id="fixturesByDate" data-action="all">All</div>
					</li>
					<li class="nav-item">
						<div class="nav-link cursor-pointer" id="live" data-action="live">Live</div>
					</li>
					<li class="nav-item">
						<div class="nav-link cursor-pointer" id="finished" data-action="finished">Finished</div>
					</li>
					<li class="nav-item">
						<div class="nav-link cursor-pointer" id="scheduled" data-action="scheduled">Scheduled</div>
					</li>
				</ul>
			</nav>
			
			<div class="align-self-center">
				<select name="date" id="listDate" style="width:200px;">
				</select>
			</div>
		</div>-->

		<div class="fixtures-navbar p-2">
			<nav class="act-btn">
				<div class="nav-link cursor-pointer" id="fixturesByDate" data-action="all">All</div>
				<div class="nav-link cursor-pointer" id="live" data-action="live">Live</div>
				<div class="nav-link cursor-pointer" id="finished" data-action="finished">Finished</div>
				<div class="nav-link cursor-pointer" id="scheduled" data-action="scheduled">Scheduled</div>
			</nav>
		
			<div class="align-self-center">
				<select name="date" id="listDate" style="width:200px;">
				</select>
			</div>
		</div>

		<div id="info">
			
		</div>

@endsection

@section('main_js')
	<script src="{{ asset('js/index.js') }}"></script>
@endsection