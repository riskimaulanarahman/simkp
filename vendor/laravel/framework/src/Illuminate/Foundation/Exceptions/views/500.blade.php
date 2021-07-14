
@extends('layouts.empty', ['paceTop' => true])

@section('message', 'Whoops, looks like something went wrong.')

@section('title', 'Error')

@section('content')
	<!-- begin error -->
	<div class="error">
		<div class="error-code">500</div>
		<div class="error-content">
			<div class="error-message">@yield('message')</div>
			<div class="error-desc mb-3 mb-sm-4 mb-md-5">
                This function may not be correct.
			</div>
			<div>
				<a href="#" onclick="history.go(-1)" class="btn btn-danger p-l-20 p-r-20">Go Back</a>
			</div>
		</div>
	</div>
	<!-- end error -->
@endsection
        

