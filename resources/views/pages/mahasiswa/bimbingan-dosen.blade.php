@extends('layouts.default')

@section('title', 'Bimbingan')

@push('css')
	<link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')

		<!-- begin row -->
		<div class="row">
            <!-- begin col-10 -->
			@if($formkp->dosen_pembimbing !== null)
            
			<div class="col-xl-12">
                @if (session('status'))
                    <div class="alert alert-success fade show">
                        <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('status') }}
                    </div>
                @endif
				<div class="panel panel-info">
					<!-- begin panel-heading -->
					<div class="panel-heading">
                        <h4 class="panel-title">Mahasiswa</h4>
                        
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
                    <a href="#" class=" btn btn-danger m-b-10" onclick="tbimbingan();">Tambah Bimbingan</i></a>

						<table id="data-table-responsive3" class="table table-striped table-bordered table-td-valign-middle">
							<thead>
								<tr>
									<th width="1%">No</th>
									<th class="text-nowrap">File</th>
									<th class="text-nowrap">Keterangan</th>
									<th class="text-nowrap">Status</th>
									<th class="text-nowrap">Tanggal Bimbingan</th>
									<th class="text-nowrap">Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php $i=1 ?>
								@foreach($datamhs as $p)
								<tr>
									<td class="text-center">{{ $i++ }}</td>
									<td><a href="{{ asset( '/data_file/' . $p->lampiran)  }}" target="_blank">{{ $p->lampiran }}</a> </td>
									<td>{{ $p->keterangan }}</td>
									@if($p->isReply == 0)
										<td><button class="btn btn-warning">Waiting</button></td>
									@else
										<td>
											<button class="btn btn-info">Replied</button>
											@if($p->isAcc == 1)
												<button class="btn btn-success">Acc Proposal</button>
											@endif
											@if($p->isAcc == 2)
												<button class="btn btn-success">Acc Seminar</button>
											@endif
										</td>
									@endif

									<td>{{ $p->created_at }}</td>
									<td>@if($p->isReply == 0) <a href="{{ route('mhs.aksi.bimbingan', ['id' => $p->id_bimbingan_dosen ,'status' => 'deleted']) }}" onclick="return confirm('Apakah anda yakin ?');" class="btn btn-danger">Hapus</a> @endif</td>
								</tr>
								@endforeach
							</tbody>

						</table>
					</div>
					<!-- end panel-body -->
				</div>

			</div>
			<div class="col-xl-12">
				<!-- begin panel -->
				<div class="panel panel-primary">
					<!-- begin panel-heading -->
					<div class="panel-heading">
						<h4 class="panel-title">Dosen Pembimbing</h4>
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

						<table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
							<thead>
								<tr>
									<th width="1%">No</th>
									<th class="text-nowrap">File Mahasiswa</th>
									<th class="text-nowrap">Keterangan Mahasiswa</th>
									<th class="text-nowrap">File Dosen</th>
									<th class="text-nowrap">Keterangan Dosen</th>
									<th class="text-nowrap">Tanggal Bimbingan</th>
								</tr>
							</thead>
							<tbody>
							<?php $i=1 ?>
								@foreach($bimbingan as $p)
								<tr>
									<td class="text-center">{{ $i++ }}</td>
									<!-- <td>{{ $p->lampiran }}</td> -->
									<td><a href="{{ asset( '/data_file/' . $p->lampiran)  }}" target="_blank">{{ $p->lampiran }}</a> </td>
									<td>{{ $p->keterangan }}</td>
									<td>@if($p->lampiran_dosen == null) tidak ada file @else <a href="{{ asset( '/data_file/' . $p->lampiran_dosen)  }}" target="_blank">{{ $p->lampiran_dosen }}</a> @endif </td>
									<td>{{ $p->keterangan_dosen }}</td>
									<td>{{ $p->updated_at }}</td>
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
			@else 
			<div class="alert alert-warning fade show">
				<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">&times;</span>
				</button>
				Anda Belum mempunyai dosen pembimbing
			</div>
			@endif
		</div>
        <!-- end row -->
        
        <div class="modal fade" id="modal-t-bimbingan">
		<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Tambah Bimbingan</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<form method="POST" class="margin-bottom-0" action="{{ route('mahasiswa.bimbingan.dosenstore') }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							
							<label class="control-label ldosen">Tahapan Bimbingan <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('tahapan') ? ' has-error' : '' }} ldosen">
                                <div class="col-md-12 m-b-15">
									<select class="form-control" name="tahapan" id="tahapan" required>
										<option value="">- Pilih Tahapan -</option>
										<option value="1">Tahap Pelaksanaan</option>
										<option value="2">Tahap Monitoring</option>
										<option value="3">Tahap Pelaporan</option>
									</select>
                                    @if ($errors->has('tahapan'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('tahapan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label ldosen">Keterangan <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('keterangan') ? ' has-error' : '' }} ldosen">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan"  required/>
                                    @if ($errors->has('keterangan'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('keterangan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label ldosen">File <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('file') ? ' has-error' : '' }} ldosen">
                                <div class="col-md-12 m-b-15">
                                    <input type="file" id="file" name="file" class="form-control" value="{{ old('file') }}"  />
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
                        <button type="submit" class="btn btn-warning" onclick="submitForm(this);">Submit</button>
                    </div>
                        </form>
                    
				</div>
		</div>
	</div>

@endsection

@push('scripts')
    <script>
        function tbimbingan() {
            $('#modal-t-bimbingan').modal('show');
        }
    </script>
	<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="/assets/js/demo/table-manage-responsive.demo.js"></script>
@endpush