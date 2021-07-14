@extends('layouts.empty', ['paceTop' => true])

@section('title', 'Error')

@section('message', 'Too many requests.')

@section('content')
	<!-- begin error -->
	<div class="error">
		<div class="error-code">429</div>
		<div class="error-content">
			<div class="error-message">@yield('message')</div>
			<div class="error-desc mb-3 mb-sm-4 mb-md-5">
                <!-- This function may not be correct. -->
			</div>
			<div>
				<a href="/" class="btn btn-danger p-l-20 p-r-20">Go Home</a>
			</div>
		</div>
	</div>
	<!-- end error -->
@endsection
        

