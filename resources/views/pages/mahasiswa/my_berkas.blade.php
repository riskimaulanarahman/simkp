@extends('layouts.default')

@section('title', 'My Berkas')

@push('css')
	<link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')

	<!-- begin row -->
	<div class="row">
		<!-- begin col-10 -->
		<div class="col-xl-12">
			<!-- begin panel -->
			<div class="panel panel-primary">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<h4 class="panel-title">My Berkas</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<!-- end panel-heading -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<div class="alert alert-warning fade show">
                        <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        Berkas mahasiswa dapat dilihat oleh Tendik, Koordinator, dan Dosen Pembimbing
                    </div>
				@if (session('status'))
                    <div class="alert alert-success fade show">
                        <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('status') }}
                    </div>
				@endif
				<a href="#" class="btn btn-info m-b-10" onclick="sendberkas();">Upload Berkas</a>
					<table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th class="text-nowrap">Module</th>
								<th width="20%" class="text-nowrap">Nama File</th>
								<th class="text-nowrap">Created at</th>
								<th class="text-nowrap">File</th>
								<th class="text-nowrap">Status</th>
					
							</tr>
						</thead>
						<tbody>
							<?php $i=1 ?>
							@foreach($berkas as $p)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $p->module }}</td>
                                <td>{{ $p->nama_file }}</td>
                                <td>{{ $p->created_at }}</td>
								<td><a href="{{ asset( '/data_berkas/' . $p->nama_file)  }}" target="_blank" class="btn btn-success"><i class="fa fa-download"></i></a> 
								<td>@if($p->isStatus == 1) <button class="btn btn-xs btn-success">Approved</button> @elseif($p->isStatus == 2) <button class="btn btn-xs btn-danger">Rejected</button> @elseif($p->isStatus == 5) <button class="btn btn-xs btn-info">from tendik</button> @elseif($p->isStatus == 6) <button class="btn btn-xs btn-info">from dosen</button> @else <button class="btn btn-xs btn-warning">waiting</button> @endif </td>
                            </tr>
                            @endforeach
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div>
			<!-- end panel -->
		</div>
		<!-- end col-10 -->
	</div>
	<!-- end row -->
	<!-- #modal-dialog -->
	<div class="modal fade" id="modal-berkas">
		<div class="modal-dialog">
			<form method="post" action="{{ route('uploadberkasmhs') }}"  enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Upload Berkas</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">

						<input type="hidden" id="bid_formkp" name="bid_formkp">
						<input type="hidden" id="bid_mhs" name="bid_mhs">

						<label class="control-label ldosen">Title <span class="text-danger">*</span></label>
						<div class="row row-space-10 {{ $errors->has('title') ? ' has-error' : '' }} ldosen">
							<div class="col-md-12 m-b-15">
								<input type="text" id="title" name="title" class="form-control nospecial" pattern="[^()/><\][\\\x22,;|]+" title="No special characters!" placeholder="" value="{{ old('title') }}" required />
								@if ($errors->has('title'))
									<span class="help-block">
										<strong class="text-red">{{ $errors->first('title') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<label class="control-label ldosen">File <span class="text-danger">*</span></label>
						<div class="row row-space-10 {{ $errors->has('file') ? ' has-error' : '' }} ldosen">
							<div class="col-md-12 m-b-15">
								<input type="file" id="file" name="file" class="form-control" value="{{ old('file') }}" required/>
								@if ($errors->has('file'))
									<span class="help-block">
										<strong class="text-red">{{ $errors->first('file') }}</strong>
									</span>
								@endif
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-warning" onclick="submitForm(this);">Upload File</button>
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection

@push('scripts')
<script>
	function sendberkas(id,id_formkp) {

		$('#modal-berkas').modal('show');
	}
</script>
	<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="/assets/js/demo/table-manage-responsive.demo.js"></script>
@endpush