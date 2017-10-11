@extends('default.template')

@section('styles')
<style type="text/css">
	#loginForm{
		margin-top: 10%;
	}
	 a small {
		color: gray;
	}
	body{
		background: #2c3e50;
	}
</style>

@endsection


@section('contents')
	<div class="col-md-6 col-md-offset-3" id="loginForm">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="text-center">Check-Point</h4>
			</div>
			<div class="panel-body">
				<h1 class="text-center">You're Account has been banned due to some violations.</h1>
			</div>
		</div>
	</div>
@endsection


@section('scripts')

@endsection