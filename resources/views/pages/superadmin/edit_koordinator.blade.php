@extends('layouts.default')

@section('title', 'Edit Koordinator')

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
					<h4 class="panel-title">Update - Koordinator</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<!-- end panel-heading -->
                @if (session('status'))
                    <div class="alert alert-info">
                        {{ session('status') }}
                    </div>
                @endif
				<!-- begin panel-body -->
				<div class="panel-body">
                <a href="{{ route('sa-koordinator-index') }}" class="btn btn-warning">Kembali</a>
                    <br/><br/>
                <form method="POST" class="margin-bottom-0" action="{{ route('sa-koordinator-update', ['id' => $koordinator->id_koor]) }}">
                        {{ csrf_field() }}
        
                            <label class="control-label">NIP <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('nip') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" value="{{ $koordinator->nip }}" required autofocus />
                                    @if ($errors->has('nip'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('nip') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- <label class="control-label">Nama <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('nama') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" value="{{ $koordinator->nama }}" required autofocus />
                                    @if ($errors->has('nama'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nama') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> --}}
                            <label class="control-label">Alamat <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('alamat') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" value="{{ $koordinator->alamat }}" required />
                                    @if ($errors->has('alamat'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <label class="control-label">Telepon <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('telepon') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="telepon" name="telepon" class="form-control" placeholder="Telepon" value="{{ $koordinator->telepon }}" required />
                                    @if ($errors->has('telepon'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('telepon') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label ljurusan">Jurusan <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('jurusan') ? ' has-error' : '' }} ljurusan">
                                <div class="col-md-12 m-b-15">
                                    <select class="form-control" name="jurusan" id="jurusan">
                                        <option value="">- Pilih Jurusan -</option>
                                        @foreach($jurusan as $id => $nama)
                                            <option value="{{ $id }}" {{ $id == $koordinator->id_jurusan ? 'selected' : '' }}>{{ $nama }}</option>
										@endforeach

                                    </select>

                                    @if ($errors->has('jurusan'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('jurusan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label lprodi">Program Studi<span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('prodi') ? ' has-error' : '' }} lprodi">
                                <div class="col-md-12 m-b-15">

                                    <select class="form-control" name="prodi" id="prodi">
                                        <option value="">- Pilih Program Studi -</option>
                                        @foreach($prodi as $id => $nama)
                                            <option value="{{ $id }}" {{ $id == $koordinator->id_prodi ? 'selected' : '' }}>{{ $nama }}</option>
										@endforeach

                                    </select>

                                    @if ($errors->has('prodi'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('prodi') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="register-buttons">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">Edit</button>
                            </div>

                            <hr />
                           
                        </form>
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