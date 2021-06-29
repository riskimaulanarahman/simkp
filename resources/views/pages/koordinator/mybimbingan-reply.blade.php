@extends('layouts.default')

@section('title', 'Reply Bimbingan')

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
					<h4 class="panel-title">Reply</h4>
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
                <a href="{{ URL::previous() }}" class="btn btn-warning">Kembali</a>
                    <br/><br/>
                <form method="POST" class="margin-bottom-0"  enctype="multipart/form-data" action="{{ route('koor.bimbingan.update', ['id' => $mybimbingan->id_bimbingan_dosen]) }}">
                        {{ csrf_field() }}
        
                            <label class="control-label">Keterangan Dosen <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('keterangan_dosen') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="keterangan_dosen" name="keterangan_dosen" class="form-control" placeholder="" value="{{ $mybimbingan->keterangan_dosen }}" required autofocus />
                                    @if ($errors->has('keterangan_dosen'))
                                        <span class="help-block">
											<strong class="text-red">{{ $errors->first('keterangan_dosen') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label ldosen">File Dosen <span class="text-danger"></span></label>
                            <div class="row row-space-10 {{ $errors->has('file') ? ' has-error' : '' }} ldosen">
                                <div class="col-md-12 m-b-15">
                                    <input type="file" id="file" name="file" class="form-control" value="{{ old('file') }}"  />
                                    @if ($errors->has('file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="register-buttons">
                                <button type="submit" class="btn btn-primary btn-block btn-lg" onclick="submitForm(this);">Submit</button>
                            </div>

                            <hr />
                           
                        </form>
				</div>
				<!-- end panel-body -->
                <div class="panel-body">
					<table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th class="text-nowrap">Nama Mahasiswa</th>
								<th class="text-nowrap">File Mahasiswa</th>
								<th class="text-nowrap">Keterangan Mahasiswa</th>
								<th class="text-nowrap">File Dosen</th>
								<th class="text-nowrap">Keterangan Dosen</th>
								<th class="text-nowrap">Tanggal Bimbingan</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1 ?>
							@foreach($getbimbingan as $p)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $p->mahasiswa->nama }}</td>
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