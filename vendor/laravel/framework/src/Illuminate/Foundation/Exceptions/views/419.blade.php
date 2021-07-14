@extends('layouts.empty', ['paceTop' => true])

@section('title', 'Page Expired')

@section('message')
    The page has expired due to inactivity.
    <br/><br/>
    Please refresh and try again.
@stop

@section('content')
	<!-- begin error -->
	<div class="error">
		<div class="error-code">419</div>
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
        
