@extends('layouts.default')

@section('title', 'Tambah User')

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
					<h4 class="panel-title">Tambah - User</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<!-- end panel-heading -->
				<!-- begin alert -->
				<div class="alert alert-warning fade show">
					<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span>
					</button>
					Pilih Role untuk menambahkan data users
				</div>
				<!-- end alert -->
				<!-- begin panel-body -->
				<div class="panel-body">
                <form method="POST" class="margin-bottom-0" action="{{ route('sa-user-store') }}">
                        {{ csrf_field() }}

                            <label class="control-label">Role <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('role') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    {{-- <input type="text" id="role" name="role" class="form-control" placeholder="role" value="{{ old('role') }}" /> --}}
                                    <select class="form-control" name="role" id="role" required>
                                        <option value="">Pilih Role</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                        <option value="dosen">Dosen</option>
                                        <option value="koordinator">Koordinator</option>
                                        <option value="tendik">Tenaga Kependidikan</option>
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label ldosen lkaryawan">NIP <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('nip') ? ' has-error' : '' }} ldosen lkaryawan">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" value="{{ old('nip') }}"  />
                                    @if ($errors->has('nip'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('nip') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- <label class="control-label lkaryawan">NIP <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('nip') ? ' has-error' : '' }} lkaryawan">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" value="{{ old('nip') }}"  />
                                    @if ($errors->has('nip'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('nip') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> --}}

                            <label class="control-label lmahasiswa">NIM <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('nim') ? ' has-error' : '' }} lmahasiswa">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="nim" name="nim" class="form-control" placeholder="NIM" value="{{ old('nim') }}"  />
                                    @if ($errors->has('nim'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('nim') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label lgeneral">Nama <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('name') ? ' has-error' : '' }} lgeneral">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}"  />
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            
                            <label class="control-label lmahasiswa">Tahun Angkatan <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('tahun_angkatan') ? ' has-error' : '' }} lmahasiswa">
                                <div class="col-md-12 m-b-15">
                                    <input type="number" id="tahun_angkatan" name="tahun_angkatan" class="form-control" placeholder="Tahun Angkatan" value="{{ old('tahun_angkatan') }}"  />
                                    @if ($errors->has('tahun_angkatan'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('tahun_angkatan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label lmahasiswa">Dosen Wali <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('dosenwali') ? ' has-error' : '' }} lmahasiswa">
                                <div class="col-md-12 m-b-15">
                                    <select class="form-control" name="dosenwali" id="dosenwali">
                                        <option value="">- Pilih Dosen Wali -</option>
                                        @foreach($dosen as $id => $nama)
                                            <option value="{{ $id }}" >{{ $nama }}</option>
										@endforeach

                                    </select>
                                    @if ($errors->has('dosenwali'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('dosenwali') }}</strong>
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
                                            <option value="{{ $id }}" >{{ $nama }}</option>
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
                                            <option value="{{ $id }}" >{{ $nama }}</option>
										@endforeach

                                    </select>

                                    @if ($errors->has('prodi'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('prodi') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label lgeneral">E-mail <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('email') ? ' has-error' : '' }} lgeneral">
                                <div class="col-md-12 m-b-15">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}" />
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label lgeneral">Alamat <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('alamat') ? ' has-error' : '' }} lgeneral">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" value="{{ old('alamat') }}"  />
                                    @if ($errors->has('alamat'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('alamat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label lgeneral">Telepon <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('telepon') ? ' has-error' : '' }} lgeneral">
                                <div class="col-md-12 m-b-15">
                                    <input type="number" id="telepon" name="telepon" class="form-control" placeholder="Telepon" value="{{ old('telepon') }}"  />
                                    @if ($errors->has('telepon'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('telepon') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <hr>

                            <label class="control-label lgeneral">Username <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('username') ? ' has-error' : '' }} lgeneral">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" />
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <label class="control-label lgeneral">Password <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('password') ? ' has-error' : '' }} lgeneral">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" />
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                           
                            <div class="register-buttons">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">Daftar</button>
                            </div>

                            <hr />

                </form>
                <a href="{{ route('sa-user-index') }}" class="btn btn-danger">Kembali</a>
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
    <script>
    $('.lmahasiswa').hide();
    $('.ldosen').hide();
    $('.lgeneral').hide();
    $('.lkaryawan').hide();
    $('.lprodi').hide();
    $('.ljurusan').hide();
    $('#role').change(function(){
        if($(this).val() === 'mahasiswa') {
            $('.lmahasiswa').show();
            $('.ldosen').hide();
            $('.lgeneral').show();
            $('.lkaryawan').hide();
            $('.ljurusan').show();
            $('.lprodi').show();
        } else if($(this).val() === 'dosen') {
            $('.lmahasiswa').hide();
            $('.ljurusan').show();
            $('.lprodi').show();
            $('.lkaryawan').hide();
            $('.ldosen').show();
            $('.lgeneral').show();
        } else if($(this).val() === 'koordinator') {
            $('.lmahasiswa').hide();
            $('.ldosen').hide();
            $('.lkaryawan').show();
            $('.ljurusan').show();
            $('.lprodi').show();
            $('.lgeneral').show();
        } else if($(this).val() === 'tendik') {
            $('.lmahasiswa').hide();
            $('.ldosen').hide();
            $('.lkaryawan').show();
            $('.ljurusan').show();
            $('.lprodi').hide();
            $('.lgeneral').show();
        } else {
            $('.lmahasiswa').hide();
            $('.ldosen').hide();
            $('.lgeneral').hide();
            $('.ljurusan').hide();
            $('.lprodi').hide();

        }
            
    })

    </script>
@endpush