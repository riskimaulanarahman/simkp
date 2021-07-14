@section('message', 'Sorry, the page you are looking for could not be found.')

@extends('layouts.empty', ['paceTop' => true])

@section('title', '404 Error Page')

@section('content')
	<!-- begin error -->
	<div class="error">
		<div class="error-code">404</div>
		<div class="error-content">
			<div class="error-message">@yield('message')</div>
			<div class="error-desc mb-3 mb-sm-4 mb-md-5">
				The page you're looking for doesn't exist. <br />
				Perhaps, there pages will help find what you're looking for.
			</div>
			<div>
				<a href="#" onclick="history.go(-1)" class="btn btn-danger p-l-20 p-r-20">Go Back</a>
			</div>
		</div>
	</div>
	<!-- end error -->
@endsection
        
