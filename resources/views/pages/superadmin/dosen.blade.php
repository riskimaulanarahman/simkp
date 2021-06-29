@extends('layouts.default')

@section('title', 'Master Dosen')

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
					<h4 class="panel-title">View - Dosen</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<!-- end panel-heading -->
				<!-- begin alert -->
				<div class="alert alert-warning fade show">
					<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span>
					</button>
                    Data Dosen Sistem Informasi Manajemen Kerja Praktik ITK<br> <b>Create New Data? Go Users Menu </b>
				</div>
				<!-- end alert -->
				<!-- begin panel-body -->
				<div class="panel-body">
                <!-- <a href="{{ route('sa-user-tambah') }}" class="btn btn-primary">Input User Baru</a> -->
                    <!-- <br/><br/> -->
					<table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th class="text-nowrap">Nama</th>
								<th class="text-nowrap">NIP</th>
								<th class="text-nowrap">Alamat</th>
								<th class="text-nowrap">Telepon</th>
								<th class="text-nowrap">Jurusan</th>
								<th class="text-nowrap">Program Studi</th>
                                <th class="text-nowrap">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1 ?>
							@foreach($dosen as $p)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $p->users->name }}</td>
                                <td>{{ $p->nip }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>{{ $p->telepon }}</td>
                                <td>{{ $p->jurusan->nama_jurusan }}</td>
                                <td>{{ $p->prodi->nama_prodi }}</td>
                                <td>
									<a href="{{ route('sa-dosen-edit', ['id' => $p->id_dosen]) }}" class="btn btn-warning">Edit</a>
									@if($p->isWali == 0)
										@if($p->isKoor == 0)
									<a href="{{ route('sa-dosen-wali', ['id' => $p->id_dosen, 'wali' => 'on']) }}" class="btn btn-primary">Active Wali</a>
										@endif
									@else
									<a href="{{ route('sa-dosen-wali', ['id' => $p->id_dosen, 'wali' => 'off']) }}" class="btn btn-danger">Non Active Wali</a>
									@endif
                                </td>
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
@endsection

@push('scripts')
	<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="/assets/js/demo/table-manage-responsive.demo.js"></script>
@endpush