<div class="col-auto px-0 sidebar-none">
	<div id="sidebar" class="collapse collapse-horizontal show border-end">
		<div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">

				@foreach ($countries as $country)
					<div class="country">
						<img src="{{ $country['flag'] }}" height="16" class="mb-1">
						<a href="{{ route('leagueByCountry', "$country[name]") }}" class="text-decoration-none text-black fixture-hover" value="{{ $country['name'] }}">{{ $country['name'] }}</a>
					</div>
				@endforeach

			<a href="#" id="loadMore">Show more</a>
		</div>
	</div>
</div>

@section('js')
	<script>
		$(document).ready(function() {
			$(".country").slice(0, 15).show();
			$("#loadMore").on("click", function(e){
				e.preventDefault();
				$(".country:hidden").slice(0, 15).slideDown();
				if($(".country:hidden").length == 0) {
					$("#loadMore").text("No Content").addClass("noContent");
				}
			});
		})
	</script>
@endsection