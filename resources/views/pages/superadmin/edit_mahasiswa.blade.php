@extends('layouts.default')

@section('title', 'Edit Mahasiswa')

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
					<h4 class="panel-title">Update - Mahasiswa</h4>
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
                <a href="{{ route('sa-mahasiswa-index') }}" class="btn btn-warning">Kembali</a>
                    <br/><br/>
                <form method="POST" class="margin-bottom-0" action="{{ route('sa-mahasiswa-update', ['id' => $mahasiswa->id_mhs]) }}">
                        {{ csrf_field() }}
                        
                            <label class="control-label">NIM <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('nim') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="nim" name="nim" class="form-control" placeholder="NIM" value="{{ $mahasiswa->nim }}" required autofocus />
                                    @if ($errors->has('nim'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('nim') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <label class="control-label">Tahun Angkatan <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('tahun_angkatan') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="tahun_angkatan" name="tahun_angkatan" class="form-control" placeholder="Tahun Angkatan" value="{{ $mahasiswa->tahun_angkatan }}" required />
                                    @if ($errors->has('tahun_angkatan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tahun_angkatan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <label class="control-label">Jurusan <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('jurusan') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <select class="form-control" name="jurusan" id="jurusan" required>
                                        @foreach($jurusan as $id => $nama)
                                        <option value="{{ $id }}" @if($id == $mahasiswa->id_jurusan) selected @endif >{{ $nama }}</option>
										@endforeach

                                    </select>
                                    @if ($errors->has('jurusan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('jurusan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <label class="control-label">Program Studi <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('prodi') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <select class="form-control" name="prodi" id="prodi" required>
                                        @foreach($prodi as $id => $nama)
                                        <option value="{{ $id }}" @if($id == $mahasiswa->id_prodi) selected @endif >{{ $nama }}</option>
										@endforeach

                                    </select>
                                    @if ($errors->has('prodi'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('prodi') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label">Dosen Wali<span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('doswal') ? ' has-error' : '' }} ">
                                <div class="col-md-12 m-b-15">

                                    <select class="form-control" name="doswal" id="doswal">
                                        <option value="">- Pilih Dosen Wali -</option>
                                        @foreach($doswal as $id => $nama)
                                            <option value="{{ $id }}" {{ $id == $mahasiswa->id_dosenwali ? 'selected' : '' }}>{{ $nama }}</option>
										@endforeach

                                    </select>

                                    @if ($errors->has('doswal'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('doswal') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <label class="control-label">Alamat <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('alamat') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" value="{{ $mahasiswa->alamat }}" required />
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
                                    <input type="text" id="telepon" name="telepon" class="form-control" placeholder="Telepon" value="{{ $mahasiswa->telepon }}" required />
                                    @if ($errors->has('telepon'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('telepon') }}</strong>
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