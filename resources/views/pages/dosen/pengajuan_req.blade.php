@extends('layouts.default')

@section('title', 'My Request')

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
					<h4 class="panel-title">My Request</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<!-- end panel-heading -->
                @if (session('status'))
                    <div class="alert alert-success fade show">
                        <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('status') }}
                    </div>
                @endif
				<form action="{{ route('dosen.request.index') }}" method="GET" class="form-inline">
					@include('includes.component.filter-tahun')
				</form>
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="text-nowrap">Module</th>
								<th width="text-nowrap">NIM</th>
								<th class="text-nowrap">Nama Mahasiswa</th>
								<th width="20%" class="text-nowrap">Nama Mitra</th>
								<th width="20%" class="">Alamat Mitra</th>
								<th class="">Jenis Bidang</th>
								<th class="">Mulai KP</th>
								<th class="text-nowrap">Selesai KP</th>
								<th class="text-nowrap">Created at</th>
								<th width="10%" class="text-nowrap">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($reqs as $p)
                            <tr>
                                <td class="text-center">{{ $p->module }}</td>
                                <td class="text-center">{{ $p->mahasiswa->nim }}</td>
                                <td>{{ $p->mahasiswa->nama }}</td>
                                <td>{{ $p->nama_mitra }}</td>
                                <td>{{ $p->alamat_mitra }}</td>
                                <td>{{ $p->jenis_bidang }}</td>
                                <td>{{ $p->periodekp }}</td>
                                <td>{{ $p->periodekp }}</td>
								<td>{{ $p->endperiode }}</td>
                                <td>
									@if($p->request_status == 0)
                                    	<a href="{{ route('dosen.request.approval', ['id' => $p->id_approval ,'status' => 'approved'] ) }}" onclick="return confirm('Apakah anda yakin ?');" class="btn btn-warning">Approve</a>
                                    	<a href="{{ route('dosen.request.approval', ['id' => $p->id_approval ,'status' => 'rejected']) }}" onclick="return confirm('Apakah anda yakin Reject ?');" class="btn btn-danger">Reject</a>
									@elseif($p->request_status == 1)
										<a href="#" class="btn btn-success">Approved</a>
									@elseif($p->request_status == 2)
										<a href="#" class="btn btn-danger">Rejected by {{$p->rejectuser}}</a>
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