@extends('layouts.default')

@section('title', 'Data Nilai Seminar')

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
					<h4 class="panel-title">Nilai Seminar Hasil KP Mahasiswa</h4>
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

				<form action="{{ route('dosen.nilaiseminar') }}" method="GET" class="form-inline">
					@include('includes.component.filter-tahun')
				</form>

				<div class="panel-body">

					<table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th class="text-nowrap" rowspan="2">No</th>
								<th class="text-nowrap" colspan="2">Data Mahasiswa</th>
								<th class="text-nowrap" colspan="3">Penilaian Pembimbing Lapangan</th>
								<th class="text-nowrap" colspan="4">Penilaian Dosen Pembimbing</th>
								<th width="20%" class="text-nowrap" rowspan="2">Total</th>
								<th class="text-nowrap" rowspan="2">Revisi/Komentar</th>
								<th class="text-nowrap" rowspan="2">Aksi</th>
							</tr>
							<tr>
								<th class="text-nowrap">NIM</th>
								<th class="text-nowrap">Nama</th>
								<th width="5%" class="text-nowrap">Laporan</th>
								<th width="5%" class="text-nowrap">Kinerja</th>
								<th width="5%" class="text-nowrap">Total</th>
								<th width="5%" class="text-nowrap">Laporan</th>
								<th width="5%" class="text-nowrap">Poster</th>
								<th width="5%" class="text-nowrap">Presentasi</th>
								<th width="5%" class="text-nowrap">Total</th>
								
							</tr>
						</thead>
						<tbody>
                            <?php $i=1 ?>
							@foreach($nilai as $p)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $p->mahasiswa->nim }}</td>
                                <td>{{ $p->mahasiswa->nama }}</td>
                                <td>{{ $p->lap_laporan }}</td>
								<td>{{ $p->lap_kinerja }}</td>
								<td>{{  (($p->lap_laporan*0.33)/1) + (($p->lap_kinerja*0.67)/1) }} %</td>
                                <td>{{ $p->dosen_laporan }}</td>
                                <td>{{ $p->dosen_poster }}</td>
								<td>{{ $p->dosen_presentasi }}</td>
								<td>{{ (($p->dosen_laporan*0.50)/1) + (($p->dosen_poster*0.25)/1) + (($p->dosen_presentasi*0.25)/1) }} %</td>
								<td>
									
								<button class="btn btn-info">
									{{ 
								 round(( ( (($p->lap_laporan*0.33)/1) + (($p->lap_kinerja*0.67)/1) )*0.33/1 ) 
								+ 
								( ( (($p->dosen_laporan*0.50)/1) + (($p->dosen_poster*0.25)/1) + (($p->dosen_presentasi*0.25)/1) )*0.67/1 ),2 )
								
								}} %
								</button> </td>
                                <td>{{ $p->revisi_komentar }}</td>
                                <td>
                                    @if($p->isStatus == 0)
                                        <a href="{{ route('dosen.editnilaiseminar', ['id' => $p->id_nilai] ) }}" class="btn btn-primary">Edit</a>
                                    @else
                                        <button class="btn btn-success">Sudah Di Nilai</button>
                                        <a href="{{ route('dosen.editnilaiseminar', ['id' => $p->id_nilai] ) }}" class="btn btn-primary">Edit</a>

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