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
					<h4 class="panel-title">My Bimbingan</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<!-- end panel-heading -->
				<form action="{{ route('koor.bimbingan') }}" method="GET" class="form-inline">
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
								<th width="text-nowrap">NIM</th>
								<th class="text-nowrap">Nama Mahasiswa</th>
                                <th class="text-nowrap">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($mybimbingan as $p)
                            <tr>
                                <td class="text-center">{{ $p->mahasiswa->nim }}</td>
								<td>{{ $p->mahasiswa->nama }}</td>
								
								<td>
									<a href="#" class="btn btn-info" onclick="showberkas({{$p->id_mhs}},{{$p->id_formkp}},'{{$p->mahasiswa->nama}}',{{$p->mahasiswa->nim}});">Berkas</a>
									<button class="btn btn-info" onclick="dtlbimbingan({{$p->id_mhs}},{{$p->id_dosen}},{{$p->id_bimbingan_dosen}},'{{$p->mahasiswa->nama}}',{{$p->mahasiswa->nim}});">Detail Bimbingan</button>
									@if($p->status_progress > 0) <button class="btn btn-warning">Waiting Reply</button> @endif
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
	<div class="modal modal-message fade" id="modal-berkas">
		<div class="modal-dialog">
			<form method="post" action="{{ route('koor.sendberkasdosen') }}"  enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Kirim Berkas ke <b id="berkas_namanim"></b></h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">

						<input type="hidden" id="bid_formkp" name="bid_formkp">
						<input type="hidden" id="bid_mhs" name="bid_mhs">

						<label class="control-label ldosen">Title <span class="text-danger">*</span></label>
						<div class="row row-space-10 {{ $errors->has('title') ? ' has-error' : '' }} ldosen">
							<div class="col-md-12 m-b-15">
								<input type="text" id="title" name="title" class="form-control" placeholder="" value="{{ old('title') }}" required />
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
									<th class="text-nowrap">File</th>
									<th class="text-nowrap">Created_at</th>
									<th class="text-nowrap">Download</th>
									<th class="text-nowrap">Status</th>
								</tr>
							</thead>
							<tbody id="detail_berkas">
								
							</tbody>
						</table>

					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-warning" onclick="submitForm(this);" >Kirim File</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="modal modal-message fade" id="modal-bimbingan">
		<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Detail Bimbingan <b id="bimbingan_namanim"></b></h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<form method="POST" class="margin-bottom-0" action="{{ route('koor.bimbingan.updateacc') }}">
							{{ csrf_field() }}
							{{-- {{ $tahapan }} --}}
							<input type="hidden" name="id_bimbingan_dosen" id="id_bimbingan_dosen">
							<div class="row row-space-10 {{ $errors->has('aksi') ? ' has-error' : '' }} laksi">
								<div class="col-md-4 m-b-15">
									<select class="form-control" name="aksi" id="aksi">
										{{-- <option value="">- Select Acc Status -</option>
										<option value="2">Acc Proposal</option>
										<option value="4">Acc Seminar</option> --}}
									</select>
									@if ($errors->has('aksi'))
										<span class="help-block">
											<strong class="text-red">{{ $errors->first('aksi') }}</strong>
										</span>
									@endif
								</div>
								<div class="col-md-4 m-b-15">
									<button id="btnaksiacc" type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
						<table id="data-table-responsive5" class="table table-striped table-bordered table-td-valign-middle">
							<thead>
								<tr>
									<th width="5%" class="text-nowrap">No</th>
									<th width="5%" class="text-nowrap">Tahapan Bimbingan</th>
									<th width="5%" class="text-nowrap">File Mahasiswa</th>
									<th width="5%" class="text-nowrap">Keterangan Mahasiswa</th>
									<th width="5%" class="text-nowrap">File Dosen</th>
									<th width="5%" class="text-nowrap">Keterangan Dosen</th>
									<th width="5%" class="text-nowrap">Tanggal Diterima</th>
									<th width="5%" class="text-nowrap">Aksi</th>
								</tr>
							</thead>
							<tbody id="dbimbingan">
								
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

	function showberkas(id,id_formkp,mhs,nim) {

		$('#modal-berkas').modal('show');

		$('#bid_mhs').val(id);
		$('#bid_formkp').val(id_formkp);

		$('#berkas_namanim').text(mhs+' ('+nim+')');

		$('#detail_berkas').html('');

			$.getJSON(base_url+'/api/detailberkas/'+id+'/'+id_formkp,function(item){
				console.log(item.data);
				$.each(item.data,function(x,y){

					if(y.isStatus == 1) {
						var statuscheck = '<div class="checkbox checkbox-css"><input type="checkbox" id="cssCheckbox'+y.id_berkas+'" checked disabled/><label for="cssCheckbox'+y.id_berkas+'">Acc</label></div>';
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
				
					// $('#cssCheckbox'+y.id_berkas).change(function(){
					// 	if(this.checked) {
					// 		// alert('on'+y.id_berkas);
					// 		$.getJSON(base_url+'/tendik/tendik-accberkas/'+y.id_berkas+'/acc',function(item){
					// 			console.log(item);
					// 		});
					// 		alert('berkas berhasil di acc');
					// 		// location.reload();
					// 	} else {
					// 		$.getJSON(base_url+'/tendik/tendik-accberkas/'+y.id_berkas+'/reject',function(item){
					// 			console.log(item);
					// 		});
					// 		alert('berkas berhasil di update');
					// 		// location.reload();
					// 	}
					// });

				});
			});
	}

	function dtlbimbingan(id_mhs,id_dosen,id_bimbingan_dosen,mhs,nim) {
		$('#modal-bimbingan').modal('show');

		$('#id_bimbingan_dosen').val(id_bimbingan_dosen);

		$('#data-table-responsive5').DataTable().destroy();
		$('#dbimbingan').html('');

		$('#bimbingan_namanim').text(mhs+' ('+nim+')');

		$('#data-table-responsive5').DataTable();

		$.getJSON(base_url+'/detail-bimbingan-mahasiswa/'+id_mhs+'/'+id_dosen,function(item){
			var count = 1;
			var statusacc = item[0].id_formkp;
			$.getJSON(base_url+'/tahapanaccmhs/'+statusacc,function(data){
				// console.log(data);
				$('#aksi').html('');
				if(data==1) {
					$('#aksi').append('<option value="">- Select Acc Status -</option><option value="2">Acc Proposal</option>');
					$('#btnaksiacc').prop('disabled',false);
					$('#aksi').prop('disabled',false);
				} else if(data==3) {
					$('#aksi').append('<option value="">- Select Acc Status -</option><option value="4">Acc Seminar</option>');
					$('#btnaksiacc').prop('disabled',false);
					$('#aksi').prop('disabled',false);
				} else {
					$('#btnaksiacc').prop('disabled',true);
					$('#aksi').prop('disabled',true);
				}
			});

			$.each(item,function(x,y){
				
				var lampiran =  '<a href="/data_file/'+y.lampiran+'" target="_blank">'+y.lampiran+'</a>';
				var lampirandosen = ((y.lampiran_dosen == null || y.lampiran_dosen == '') ? "tidak ada file" : '<a href="/data_file/'+y.lampiran_dosen+'" target="_blank">'+ y.lampiran_dosen+'</a>');

				if(y.isAcc == 1) {
					statusacc = '<button class="btn btn-success">Acc Proposal</button>';
				} else if(y.isAcc == 2) {
					statusacc = '<button class="btn btn-success">Acc Seminar</button>';
				} else {
					statusacc = '';
				}

				if(y.isReply !== 1) {
					var aksi = '<a href="/koor/bimbingan-reply/'+y.id_bimbingan_dosen+'" class="btn btn-warning">Reply</a>';
				} else {
					var aksi = '<button class="btn btn-info">Replied</button>'+statusacc;
				}
				$('#data-table-responsive5').DataTable().row.add($('<tr><td>'+(count++)+'</td><td>'+y.nama_tahapan+'</td><td>'+lampiran+'</td><td>'+y.keterangan+'</td><td>'+lampirandosen+'</td><td>'+((y.keterangan_dosen == null) ? "belum reply" : y.keterangan_dosen)+'</td><td>'+y.created_at+'</td><td>'+aksi+'</td></tr>')).draw();
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