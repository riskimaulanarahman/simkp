@extends('layouts.default')

@section('title', 'Dashboard Koordinator')

@push('css')
	<link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
	<link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
@endpush

@section('content')
	<!-- begin breadcrumb -->
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Dashboard <?php echo Auth::user()->role; ?></h1>
	<!-- end page-header -->
	
	<!-- end row -->
	<!-- begin row -->
	<div class="row">
		
	</div>
	<!-- end row -->

	<!-- end row -->
@endsection



@push('scripts')
	<script src="/assets/plugins/d3/d3.min.js"></script>
	<script src="/assets/plugins/nvd3/build/nv.d3.js"></script>
	<script src="/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
	<script src="/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
	<script src="/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
	<script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
	<!-- <script src="/assets/js/keldashboard.js?n=113"></script> -->
	<!-- <script src="/assets/js/demo/dashboard-v2.js"></script> -->
@endpush