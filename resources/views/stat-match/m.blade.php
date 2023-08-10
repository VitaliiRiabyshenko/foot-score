@extends('layouts.base')

@section('title', '| Home')

@section('content')

<div class="d-flex justify-content-center p-2">
	<div class="align-self-center">
		<select name="date" id="listDate" style="width:200px;">
			<option value="2023-02-13">02-13  Mon</option>
			<option value="2023-02-14">02-14  Tue</option>
			<option value="2023-02-15">02-15  Wed</option>
			<option value="2023-02-16">02-16  Thu</option>
			<option value="2023-02-17">02-17  Fri</option>
			<option value="2023-02-18">02-18  Sat</option>
			<option value="2023-02-19">02-19  Sun</option>
			<option value="2023-02-20">02-20  Mon</option>
			<option value="2023-02-21">02-21  Tue</option>
			<option value="2023-02-22" selected="">Today</option>
			<option value="2023-02-23">02-23  Thu</option>
			<option value="2023-02-24">02-24  Fri</option>
			<option value="2023-02-25">02-25  Sat</option>
			<option value="2023-02-26">02-26  Sun</option>
			<option value="2023-02-27">02-27  Mon</option>
			<option value="2023-02-28">02-28  Tue</option>
			<option value="2023-03-01">03-01  Wed</option>
			<option value="2023-03-02">03-02  Thu</option>
			<option value="2023-03-03">03-03  Fri</option>
			<option value="2023-03-04">03-04  Sat</option>
			<option value="2023-03-05">03-05  Sun</option>
		</select>
	</div>
</div>




@endsection

@section('main_js')
<script>

</script>
@endsection