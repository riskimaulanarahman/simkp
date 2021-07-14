@extends('layouts.empty', ['paceTop' => true])

@section('title', 'Login Page')

@section('content')
	<!-- begin login-cover -->
	<div class="login-cover">
		<div class="login-cover-image" style="background-image: url(/assets/img/login-bg/bgitk.jpeg)" data-id="login-cover-image"></div>
		<div class="login-cover-bg"></div>
	</div>
	<!-- end login-cover -->
	
	<!-- begin login - -->
	<div class="login login-v2" data-pageload-addclass="animated fadeIn">
		<!-- begin brand -->
		@if (session('status'))
			<div class="alert alert-info">
				{{ session('status') }}
			</div>
		@endif
		<div class="login-header">
			<div class="brand">
				<b>SIM-KP ITK</b>
				<small>Sistem Informasi Manajemen Kerja Praktik ITK</small>
			</div>
		</div>
		<!-- end brand -->
		<!-- begin login-content -->
		<div class="login-content">
			<form action="{{ route('login') }}" method="POST" class="margin-bottom-0">
				{{ csrf_field() }}
				<div class="form-group m-b-20">
					<input id="login" type="text" class="form-control form-control-lg {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="login" value="{{ old('username') ?: old('username') }}"  placeholder="Username " required autofocus>
				@if ($errors->has('username') || $errors->has('email'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
				</span>
				@endif
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} m-b-20">
					<input id="password" type="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>

				<div class="login-buttons btn-inline">
					<button type="submit" class="btn btn-success btn-lg">Login</button>
					<a href="{{route('register-mahasiswa')}}" class="btn btn-danger btn-lg">Register Mahasiswa</a>
				</div>
				<div class="m-t-20">
					Cek Jadwal Seminar KP ? Click <a href="{{route('home.cekjadwalseminar')}}" class="btn btn-xs btn-success" target="_blank">HERE</a>
				</div>
				<hr />
				<p class="text-center text-grey-darker mb-0">
					&copy; 2021 Institut Teknologi Kalimantan by Naufal Hartanto
				</p>
			</form>
		</div>
		<!-- end login-content -->
	</div>
	<!-- end login -->
	
	<!-- begin login-bg -->
	{{-- <ul class="login-bg-list clearfix">
		<li class="active"><a href="javascript:;" data-click="change-bg" data-img="/assets/img/login-bg/login-bg-17.jpg" style="background-image: url(/assets/img/login-bg/login-bg-17.jpg)"></a></li>
		<li><a href="javascript:;" data-click="change-bg" data-img="/assets/img/login-bg/login-bg-16.jpg" style="background-image: url(/assets/img/login-bg/login-bg-16.jpg)"></a></li>
		<li><a href="javascript:;" data-click="change-bg" data-img="/assets/img/login-bg/login-bg-15.jpg" style="background-image: url(/assets/img/login-bg/login-bg-15.jpg)"></a></li>
		<li><a href="javascript:;" data-click="change-bg" data-img="/assets/img/login-bg/login-bg-14.jpg" style="background-image: url(/assets/img/login-bg/login-bg-14.jpg)"></a></li>
		<li><a href="javascript:;" data-click="change-bg" data-img="/assets/img/login-bg/login-bg-13.jpg" style="background-image: url(/assets/img/login-bg/login-bg-13.jpg)"></a></li>
		<li><a href="javascript:;" data-click="change-bg" data-img="/assets/img/login-bg/login-bg-12.jpg" style="background-image: url(/assets/img/login-bg/login-bg-12.jpg)"></a></li>
	</ul> --}}
	<!-- end login-bg -->
@endsection

@push('scripts')
	<script src="/assets/js/demo/login-v2.demo.js"></script>
@endpush
