@extends('layouts.default')

@section('title', 'Pengajuan KP')

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
				<!-- begin panel-body -->
				<div class="panel-body">
				@if (session('status'))
                    <div class="alert alert-success fade show">
                        <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('status') }}
                    </div>
                @endif

                @if($code == 200)
                <a href="{{ route('mahasiswa.pengajuan.add') }}" class="btn btn-primary m-b-10">Add</a>
                
                @else
                    <div class="alert alert-success fade show">
                        <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        Anda Sudah Melakukan Pengajuan
                    </div>
                
                @endif

					<table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th class="text-nowrap">Nama</th>
								<th width="10%" class="text-nowrap">Dosen Pembimbing</th>
								<th width="10%" class="text-nowrap">Nama Mitra</th>
								<th class="text-nowrap">Alamat Mitra</th>
								<th class="text-nowrap">Jenis Bidang</th>
								<th class="text-nowrap">Mulai KP</th>
								<th class="text-nowrap">Selesai KP</th>
								<th class="text-nowrap">Status</th>
					
							</tr>
						</thead>
						<tbody>
							<?php $i=1 ?>
							@foreach($formkp as $p)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $p->users->name }} ( {{ $p->mahasiswa->nim }} )</td>
                                <td>@if($p->dosen_pembimbing == null || $p->dosen_pembimbing == '') <span class="btn btn-xs btn-warning">belum ada pembimbing</span> @else {{ $p->dosens->nama }} @endif</td>
                                <td>{{ $p->nama_mitra }}</td>
                                <td>{{ $p->alamat_mitra }}</td>
                                <td>{{ $p->jenis_bidang }}</td>
                                <td>{{ $p->periodekp }}</td>
                                <td>{{ $p->endperiode }}</td>
                                <td>@if($p->isStatus == 0) 
										<button class="btn btn-xs btn-warning">Acc Dosen Wali</button>
										<button class="btn btn-xs btn-warning">Acc Tendik</button>
										<button class="btn btn-xs btn-warning">Get Pembimbing</button>
										<button class="btn btn-xs btn-warning">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Progress KP</button>
										<button class="btn btn-xs btn-warning">Done KP</button>
										<button class="btn btn-xs btn-warning">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Seminar</button>
										<button class="btn btn-xs btn-warning">Finish</button>
									@elseif($p->isStatus == 1)
										<button class="btn btn-xs btn-success">Acc Dosen Wali</button>
										<button class="btn btn-xs btn-warning">Acc Tendik</button>
										<button class="btn btn-xs btn-warning">Get Pembimbing</button>
										<button class="btn btn-xs btn-warning">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Progress KP</button>
										<button class="btn btn-xs btn-warning">Done KP</button>
										<button class="btn btn-xs btn-warning">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Seminar</button>
										<button class="btn btn-xs btn-warning">Finish</button>
									@elseif($p->isStatus == 2)
										<button class="btn btn-xs btn-success">Acc Dosen Wali</button>
										<button class="btn btn-xs btn-success">Acc Tendik</button>
										<button class="btn btn-xs btn-warning">Get Pembimbing</button>
										<button class="btn btn-xs btn-warning">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Progress KP</button>
										<button class="btn btn-xs btn-warning">Done KP</button>
										<button class="btn btn-xs btn-warning">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Seminar</button>
										<button class="btn btn-xs btn-warning">Finish</button>
									@elseif($p->isStatus == 3)
										<button class="btn btn-xs btn-success">Acc Dosen Wali</button>
										<button class="btn btn-xs btn-success">Acc Tendik</button>
										<button class="btn btn-xs btn-success">Get Pembimbing</button>
										<button class="btn btn-xs btn-warning">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Progress KP</button>
										<button class="btn btn-xs btn-warning">Done KP</button>
										<button class="btn btn-xs btn-warning">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Seminar</button>
										<button class="btn btn-xs btn-warning">Finish</button>
									@elseif($p->isStatus == 4)
										<button class="btn btn-xs btn-success">Acc Dosen Wali</button>
										<button class="btn btn-xs btn-success">Acc Tendik</button>
										<button class="btn btn-xs btn-success">Get Pembimbing</button>
										<button class="btn btn-xs btn-success">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Progress KP</button>
										<button class="btn btn-xs btn-warning">Done KP</button>
										<button class="btn btn-xs btn-warning">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Seminar</button>
										<button class="btn btn-xs btn-warning">Finish</button>
									@elseif($p->isStatus == 5)
										<button class="btn btn-xs btn-success">Acc Dosen Wali</button>
										<button class="btn btn-xs btn-success">Acc Tendik</button>
										<button class="btn btn-xs btn-success">Get Pembimbing</button>
										<button class="btn btn-xs btn-success">Acc Pembimbing</button>
										<button class="btn btn-xs btn-success">Progress KP</button>
										<button class="btn btn-xs btn-warning">Done KP</button>
										<button class="btn btn-xs btn-warning">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Seminar</button>
										<button class="btn btn-xs btn-warning">Finish</button>
									@elseif($p->isStatus == 6)
										<button class="btn btn-xs btn-success">Acc Dosen Wali</button>
										<button class="btn btn-xs btn-success">Acc Tendik</button>
										<button class="btn btn-xs btn-success">Get Pembimbing</button>
										<button class="btn btn-xs btn-success">Acc Pembimbing</button>
										<button class="btn btn-xs btn-success">Progress KP</button>
										<button class="btn btn-xs btn-success">Done KP</button>
										<button class="btn btn-xs btn-warning">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Seminar</button>
										<button class="btn btn-xs btn-warning">Finish</button>
									@elseif($p->isStatus == 7)
										<button class="btn btn-xs btn-success">Acc Dosen Wali</button>
										<button class="btn btn-xs btn-success">Acc Tendik</button>
										<button class="btn btn-xs btn-success">Get Pembimbing</button>
										<button class="btn btn-xs btn-success">Acc Pembimbing</button>
										<button class="btn btn-xs btn-success">Progress KP</button>
										<button class="btn btn-xs btn-success">Done KP</button>
										<button class="btn btn-xs btn-success">Acc Pembimbing</button>
										<button class="btn btn-xs btn-warning">Seminar</button>
										<button class="btn btn-xs btn-warning">Finish</button>
									@elseif($p->isStatus == 8)
										<button class="btn btn-xs btn-success">Acc Dosen Wali</button>
										<button class="btn btn-xs btn-success">Acc Tendik</button>
										<button class="btn btn-xs btn-success">Get Pembimbing</button>
										<button class="btn btn-xs btn-success">Acc Pembimbing</button>
										<button class="btn btn-xs btn-success">Progress KP</button>
										<button class="btn btn-xs btn-success">Done KP</button>
										<button class="btn btn-xs btn-success">Acc Pembimbing</button>
										<button class="btn btn-xs btn-success">Seminar</button>
										<button class="btn btn-xs btn-warning">Finish</button>
									@elseif($p->isStatus == 9)
										<button class="btn btn-xs btn-success">Finish</button>
										<a href="#" class="btn btn-xs btn-info" onclick="shownilai({{$p->mahasiswa->id_mhs}},{{$p->id_formkp}});">Nilai</a>

									@else
										<button class="btn btn-xs btn-danger">Rejected by {{$p->rejectuser}}</button>
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
	<!-- #modal-dialog -->
	<div class="modal modal-message fade" id="modal-nilai">
		<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Nilai</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
							<thead>
								<tr>
									<th width="5%" class="text-nowrap">Laporan (pembimbing lapangan)</th>
									<th width="5%" class="text-nowrap">Kinerja (pembimbing lapangan)</th>
									<th width="5%" class="text-nowrap">Laporan (dosen pembimbing)</th>
									<th width="5%" class="text-nowrap">Poster (dosen pembimbing)</th>
									<th width="5%" class="text-nowrap">Presenstasi (dosen pembimbing)</th>
									<th width="5%" class="text-nowrap">Revisi/Komentar</th>
									<th width="5%" class="text-nowrap">Total</th>
								</tr>
							</thead>
							<tbody id="detail_nilai">
								
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
					</div>
				</div>
		</div>
	</div>

@endsection


@push('scripts')
	<script>
		let base_url = window.location.origin;

		function shownilai(id) {
			$('#modal-nilai').modal('show');
			$('#detail_nilai').html('');
			$.getJSON(base_url+'/api/detailnilai/'+id,function(item){
				console.log(item);
				$.each(item.data,function(x,y){

					var total = ( ( ((y.lap_laporan*0.33)/1) + ((y.lap_kinerja*0.67)/1) )*0.33/1 ) 
								+ 
								( ( ((y.dosen_laporan*0.50)/1) + ((y.dosen_poster*0.25)/1) + ((y.dosen_presentasi*0.25)/1) )*0.67/1 );
					total = total.toFixed(2);
					$('#detail_nilai').append(
						'<tr> <td>'+y.lap_laporan+'</td> <td>'+y.lap_kinerja+'</td> <td>'+y.dosen_laporan+'</td>'+
						'<td>'+y.dosen_poster+'</td> <td>'+y.dosen_presentasi+'</td>'+
						'<td>'+y.revisi_komentar+'</td>'+
						'<td>'+total+' %</td>'+
						 '</tr>'
					)
				});
			});
		}
	</script>

	<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="/assets/js/demo/table-manage-responsive.demo.js"></script>
@endpush