@extends('layouts.default')

@section('title', 'Master Prodi')

@push('css')
	{{-- <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" /> --}}
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
					<h4 class="panel-title">View - Program Studi</h4>
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
                <a href="{{ route('sa-prodi-tambah') }}" class="btn btn-primary">Input Program Studi Baru</a>
                    <br/><br/>
					<table class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th class="text-nowrap">Nama Jurusan</th>
								<th class="text-nowrap">Nama Prodi</th>
								<th class="text-nowrap">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1 ?>
							@foreach($prodi as $key => $p)
                            <tr>
                                <td class="text-center">{{ $prodi->firstItem() + $key }}</td>
                                <td>{{ $p->jurusan->nama_jurusan }}</td>
                                <td>{{ $p->nama_prodi }}</td>
                                <td>
                                    <a href="{{ route('sa-prodi-edit', ['id' => $p->id_prodi]) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('sa-prodi-deleted', ['id' => $p->id_prodi ]) }}" onclick="return confirm('Apakah anda yakin, menghapus item ini ?');" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
						</tbody>
					</table>
					{{ $prodi->links("pagination::bootstrap-4") }}
				</div>
				<!-- end panel-body -->
			</div>
			<!-- end panel -->
		</div>
		<!-- end col-10 -->
	</div>
	<!-- end row -->
@endsection

@push('scripts')
	{{-- <script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="/assets/js/demo/table-manage-responsive.demo.js"></script> --}}
@endpush