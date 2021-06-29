@extends('layouts.default')

@section('title', 'Data KP Mahasiswa')

@push('css')
	<link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />

	<link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="/assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="/assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
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
					<h4 class="panel-title">Data Mahasiswa KP</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<!-- end panel-heading -->
				<form action="{{ route('koor.datamhskoor') }}" method="GET" class="form-inline">
					@include('includes.component.filter-tahun')
				</form>
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

				

					<table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th class="text-nowrap">Nama Mahasiswa</th>
								<th width="10%" class="text-nowrap">Dosen Pembimbing</th>
								<th width="10%" class="text-nowrap">Nama Mitra</th>
								<th class="text-nowrap">Alamat Mitra</th>
								<th class="text-nowrap">Jenis Bidang</th>
								<th class="text-nowrap">Mulai KP</th>
								<th class="text-nowrap">Selesai KP</th>
								<th class="text-nowrap">Status</th>
								<th class="text-nowrap">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							@foreach($formkp as $p)
                            <tr>
                                <td class="text-center">{{$no++}}</td>
                                <td>{{ $p->mahasiswa->nama }} ( {{ $p->mahasiswa->nim }} )</td>
								<td>@if($p->isStatus !== 9) <a href="#" class="btn btn-xs btn-info" onclick="dospem({{$p->id_formkp}});">Set Pembimbing</a> @endif <br>@if(isset($p->dosens->nama)) {{$p->dosens->nama}} @endif</td>
								{{-- <td>@if(empty($p->dosen_pembimbing)) <a href="#" class="btn btn-xs btn-info" onclick="dospem({{$p->id_formkp}});">Set Pembimbing</a> @else {{$p->dosens->nama}} @endif </td> --}}
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
									<button class="btn btn-xs btn-warning" onclick="progresskp({{$p->id_formkp}});">Progress KP</button>
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
									<a href="#" class="btn btn-danger btn-icon btn-xs" onclick="rollback('progresskp',{{$p->id_formkp}})">
										<i class="fa fa-redo"></i>
									</a>
									<button class="btn btn-xs btn-warning" onclick="donekp({{$p->id_formkp}});">Done KP</button>
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
								@else
									<button class="btn btn-xs btn-danger">Rejected</button>
								 @endif
							</td>
							<td>
								@if($p->isStatus == 8)
									<a href="#" class="btn btn-xs btn-warning" onclick="setjadwal({{$p->id_formkp}});">Set Jadwal</a>
								@endif
								@if($p->isStatus !== 9)
									<a href="#" class="btn btn-xs btn-info" onclick="showberkas({{$p->id_mhs}},{{$p->id_formkp}});">Berkas</a>
									<a href="#" class="btn btn-xs btn-info" onclick="shownilai({{$p->id_mhs}},{{$p->id_formkp}});">Nilai</a>
								@endif
							</td>
                                {{-- <td><a href="#" class="btn btn-xs btn-info" onclick="showberkas({{$p->id_mhs}},{{$p->id_formkp}});">Kirim Berkas</a></td> --}}
								
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
	<div class="modal fade" id="modal-dialog">
		<div class="modal-dialog">
			<form method="post" action="{{ route('koor.updpembimbing') }}">
				{{ csrf_field() }}
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Pilih Dosen</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<div class="col-md-12 m-b-15">
							<input type="hidden" id="id_formkp" name="id_formkp">
							<select class="form-control" name="dosen_pembimbing" id="dosen_pembimbing">
								<option value="">- null -</option>
								{{-- @foreach($dosen as $id => $nama)
									<option value="{{ $id }}" >{{ $nama }}</option>
								@endforeach --}}

							</select>
						</div>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-success" onclick="submitForm(this);">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- #modal-dialog -->
	<div class="modal modal-message fade" id="modal-berkas">
		<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Berkas</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">

						<table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
							<thead>
								<tr>
									<th width="1%">ID</th>
									<th class="text-nowrap">Module</th>
									<th class="text-nowrap">Nama File</th>
									<th class="text-nowrap">Created_at</th>
									<th class="text-nowrap">Download</th>
									<th class="text-nowrap">Aksi</th>
								</tr>
							</thead>
							<tbody id="detail_berkas">
								
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
					</div>
				</div>
			</form>
		</div>
	</div>

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

	<!-- #modal-dialog -->
	<div class="modal fade" id="modal-jadwal">
		<div class="modal-dialog">
			<form method="post" action="{{ route('koor.storejadwal') }}"  enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Set Jadwal Seminar Hasil KP</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">


						<label class="control-label">Ruang Seminar <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('ruang') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <select class="form-control" name="ruang" id="ruang" required>
                                        @foreach($ruang as $id => $nama)
										<option value="{{ $id }}" >{{ $nama }}</option>
										{{-- <option value="{{ $id }}" @if($id == $jadwal->id_ruang) selected @endif >{{ $nama }}</option> --}}
										@endforeach

                                    </select>
                                    @if ($errors->has('ruang'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ruang') }}</strong>
                                        </span>
                                    @endif
                                </div>
							</div>
							
						<input type="hidden" id="sid_formkp" name="sid_formkp" value="">


							<label class="control-label">Tanggal Seminar <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('tanggal_sidang') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" class="form-control" name="tanggal_sidang" id="datetimepicker1" placeholder="" value=""/>

                                    @if ($errors->has('tanggal_sidang'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tanggal_sidang') }}</strong>
                                        </span>
                                    @endif
                                </div>
							</div>
							
							<label class="control-label">Status <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('isSidang') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <select class="form-control" name="isSidang" id="isSidang" required>
										<option value="0">Belum Seminar</option>
										<option value="1">Sudah Seminar</option>
                                    </select>
                                    @if ($errors->has('isSidang'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('isSidang') }}</strong>
                                        </span>
                                    @endif
                                </div>
							</div>


					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-warning" onclick="submitForm(this);">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('scripts')
	<script>
		let base_url = window.location.origin;

		function setjadwal(id) {
			$('#modal-jadwal').modal('show');
			// alert(id);
			$('#sid_formkp').val(id);


			$.getJSON(base_url+'/koor/koor-cekjadwal/'+id,function(item) {
				console.log(item);
				$('#datetimepicker1').val(item.tanggal_sidang);
				$('#ruang').val(item.id_ruang);
				$('#isSidang').val(item.isSidang);
			});

		}

		function progresskp(id) {
			if (confirm('Apakah anda yakin ?')) {
				// Save it!
				$.getJSON(base_url+'/api/progresskp/'+id);
					location.reload();
					alert('update berhasil');
			} else {
				// Do nothing!
				console.log('cancel');
				location.reload();
			}
		}

		// function rollback(status,id) {
		// 	if (confirm('Apakah anda yakin ingin rollback ?')) {
		// 		// Save it!
		// 		$.getJSON(base_url+'/api/rollbackkp/'+id);
		// 			location.reload();
		// 			alert('rollback berhasil');
		// 	} else {
		// 		// Do nothing!
		// 		console.log('cancel');
		// 		location.reload();
		// 	}
		// }

		function donekp(id) {
			if (confirm('Apakah anda yakin ?')) {
				// Save it!
				$.getJSON(base_url+'/api/donekp/'+id);
					location.reload();
					alert('update berhasil');
			} else {
				// Do nothing!
				console.log('cancel');
				location.reload();
			}
		}

		function dospem(id) {
			$('#modal-dialog').modal('show');
			// alert(id);
			$('#id_formkp').val(id);

			$('#dosen_pembimbing').html('');
			$('#dosen_pembimbing').append('<option value="">- Pilih dosen-</option>');
			$.getJSON(base_url+'/api/dosenbase/'+id,function(item){
				console.log(item);
				$.each(item,function(x,y){
					$('#dosen_pembimbing').append('<option value="'+x+'">'+y+'</option>');
				});

			});
		}

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

		function showberkas(id,id_formkp) {

			$('#modal-berkas').modal('show');

			$('#detail_berkas').html('');

			$.getJSON(base_url+'/api/detailberkas/'+id+'/'+id_formkp,function(item){
				console.log(item.data);
				$.each(item.data,function(x,y){
					if(y.isStatus == 1) {
						var statuscheck = '<div class="checkbox checkbox-css is-valid"><input type="checkbox" checked disabled/><label for="cssCheckbox'+y.id_berkas+'">Acc</label></div>';
					}else if(y.isStatus == 2) {
						var statuscheck = '<div class="checkbox checkbox-css is-invalid"><input type="checkbox" checked disabled/><label for="rejectbox'+y.id_berkas+'">Reject</label></div>';
					}else if(y.isStatus == 5) {
						var statuscheck = ' <span class="btn btn-xs btn-info">from tendik</span>';
					}else if(y.isStatus == 6) {
						var statuscheck = ' <span class="btn btn-xs btn-info">from dosen</span>';
					} else {
						var statuscheck = '<div class="checkbox checkbox-css"><input type="checkbox" id="cssCheckbox'+y.id_berkas+'" /><label for="cssCheckbox'+y.id_berkas+'">Acc</label></div>';
					}

					$('#detail_berkas').append(
						'<tr> <td>'+y.id_berkas+'</td> <td>'+y.module+'</td> <td>'+y.nama_file+'</td> <td>'+y.created_at+'</td> <td><a href="'+base_url+'/data_berkas/'+y.nama_file+'" target="_blank" class="btn btn-success"><i class="fa fa-download"></i></a>'+
							'<td>'+statuscheck+'</td>'+
							'</tr>'
					);

				});
			});
		}
	</script>
	<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="/assets/js/demo/table-manage-responsive.demo.js"></script>

	<script src="/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="/assets/plugins/moment/moment.js"></script>
	<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="/assets/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<script src="/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="/assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
	<script src="/assets/plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="/assets/plugins/tag-it/js/tag-it.min.js"></script>
	<script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="/assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="/assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="/assets/plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
	<script src="/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="/assets/plugins/clipboard/dist/clipboard.min.js"></script>
	<script src="/assets/js/demo/form-plugins.demo.js"></script>
@endpush