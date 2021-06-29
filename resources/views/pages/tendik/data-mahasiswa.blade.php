@extends('layouts.default')

@section('title', 'Data KP Mahasiswa')

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
					<h4 class="panel-title">Data Mahasiswa KP</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<!-- end panel-heading -->
				<form action="{{ route('tendik.datamhs') }}" method="GET" class="form-inline">
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
								<th class="text-nowrap">Nama</th>
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
							<?php $i = 1; ?>
							@foreach($formkp as $p)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $p->mahasiswa->nama }} ( {{ $p->mahasiswa->nim }} )</td>
								<td>@if(empty($p->dosen_pembimbing)) <a href="#" class="btn btn-xs btn-warning">Belum Ditentukan</a> @else {{$p->dosens->nama}} @endif </td>
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
									<button class="btn btn-xs btn-warning" onclick="seminar({{$p->id_formkp}});">Seminar</button>
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
									<button class="btn btn-xs btn-warning" onclick="finish({{$p->id_formkp}});">Finish</button>
								@elseif($p->isStatus == 9)
									<button class="btn btn-xs btn-success">Finish</button>
								@else
									<button class="btn btn-xs btn-danger">Rejected</button>
								 @endif
							</td>
								<td>
									@if($p->isStatus !== 9)
									<a href="#" class="btn btn-xs btn-info" onclick="showberkas({{$p->id_mhs}},{{$p->id_formkp}},'{{$p->mahasiswa->nama}}',{{$p->mahasiswa->nim}});">Berkas</a>
									<a href="#" class="btn btn-xs btn-info" onclick="shownilai({{$p->id_mhs}},'{{$p->mahasiswa->nama}}',{{$p->mahasiswa->nim}});">Nilai</a>
									<a href="{{ route('tendik.mitra-edit', ['id' => $p->id_mitrakp]) }}" class="btn btn-xs btn-inverse">Edit Mitra</a>
									@else 
									<a href="#" class="btn btn-danger btn-icon btn-xs" >
										<i class="fa fa-redo"></i> 
									</a> <button class="btn btn-danger btn-xs" onclick="rollback('finish',{{$p->id_formkp}})"> Rollback Finish </button>
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
	<div class="modal fade" id="modal-dialog">
		<div class="modal-dialog">
			<form method="post" action="{{ route('tendik.updpembimbing') }}">
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
								<option value="">- Pilih dosen-</option>
								@foreach($dosen as $id => $nama)
									<option value="{{ $id }}" >{{ $nama }}</option>
								@endforeach

							</select>
						</div>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-success">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- #modal-dialog -->
	<div class="modal modal-message fade" id="modal-berkas">
		<div class="modal-dialog">
			<form method="post" action="{{ route('tendik.sendberkastendik') }}"  enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Kirim Berkas Ke <b id="berkas_namanim"></b></h4>
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
						<button type="submit" class="btn btn-warning" onclick="submitForm(this);">Kirim File</button>
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
						<h4 class="modal-title"><b id="nilai_namanim"></b> - Nilai dari Pembimbing Lapangan</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						{{-- <a href="{{ route('tendik.editnilaimahasiswa', ['id' => 1] ) }}" class="btn btn-primary m-b-10">Input Nilai Pembimbing Lapangan</a> --}}
						<a href="" class="btn btn-primary m-b-10" id="inputnilailapangan">Input Nilai Pembimbing Lapangan</a>

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

		function seminar(id) {
			if (confirm('Apakah anda yakin semua berkas sudah lengkap ?')) {
				// Save it!
				$.getJSON(base_url+'/api/seminar/'+id);
					location.reload();
					alert('update berhasil');
			} else {
				// Do nothing!
				console.log('cancel');
				location.reload();
			}
		}

		function finish(id) {
			if (confirm('Apakah anda yakin ?')) {
				// Save it!
				$.getJSON(base_url+'/api/finish/'+id);
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
		}

		function shownilai(id,mhs,nim) {
			$('#modal-nilai').modal('show');

			$('#nilai_namanim').text(mhs+' ('+nim+')');

			$('#detail_nilai').html('');
			$.getJSON(base_url+'/api/detailnilai/'+id,function(item){
				var idnilai = item.data[0].id_nilai;
				$("#inputnilailapangan").attr("href", "/tendik/nilai-mahasiswa-edit/"+idnilai)
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

		function showberkas(id,id_formkp,mhs,nim) {
			var n = '_'+nim;
			console.log(n);
			$('#modal-berkas').modal('show');

			$('#bid_formkp').val(id_formkp);
			$('#bid_mhs').val(id);
			$('#berkas_namanim').text(mhs+' ('+nim+')');
			// console.log(mahasiswa+nim)

			$('#detail_berkas').html('');

			$.getJSON(base_url+'/api/detailberkas/'+id+'/'+id_formkp,function(item){
				console.log(item.data);
				var count = 1;
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
						var statuscheck = '<div class="checkbox checkbox-css form-check form-check-inline"><input type="checkbox" id="cssCheckbox'+y.id_berkas+'" /><label for="cssCheckbox'+y.id_berkas+'">Acc</label> &nbsp; <input type="checkbox" id="rejectbox'+y.id_berkas+'" /><label for="rejectbox'+y.id_berkas+'">Reject</label></div>';
					}

					$('#detail_berkas').append(
						'<tr> <td>'+ (count++) +'</td> <td>'+y.module+'</td> <td>'+y.nama_file+'</td> <td>'+y.created_at+'</td> <td><a href="'+base_url+'/data_berkas/'+y.nama_file+'" target="_blank" class="btn btn-success"><i class="fa fa-download"></i></a>'+
							'<td>'+statuscheck+'</td>'+
							'</tr>'
					);
				
					$('#cssCheckbox'+y.id_berkas).change(function(){
						if(this.checked) {
								$("#rejectbox"+y.id_berkas).prop('checked', false); 


								$.getJSON(base_url+'/tendik/tendik-accberkas/'+y.id_berkas+'/acc',function(item){
									console.log(item);
								});
								alert('berkas berhasil di acc');

							// alert('on'+y.id_berkas);
							
							// location.reload();
						} else {
							$.getJSON(base_url+'/tendik/tendik-accberkas/'+y.id_berkas+'/cancel',function(item){
								console.log(item);
							});
							alert('berkas berhasil di update');
						}
					});

					$('#rejectbox'+y.id_berkas).change(function(){
						if(this.checked) {
							// $('#cssCheckbox'+y.id_berkas).removeAttr('checked');
							$("#cssCheckbox"+y.id_berkas).prop('checked', false); 
							$.getJSON(base_url+'/tendik/tendik-accberkas/'+y.id_berkas+'/reject',function(item){
								console.log(item);
							});
							alert('berkas berhasil di reject');
						}else {
							$.getJSON(base_url+'/tendik/tendik-accberkas/'+y.id_berkas+'/cancel',function(item){
								console.log(item);
							});
							alert('berkas berhasil di update');
						}
					})

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