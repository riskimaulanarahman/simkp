@extends('layouts.empty', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', 'Register Page')

@section('content')
	<!-- begin register -->
	<div class="register register-with-news-feed">
		<!-- begin news-feed -->
		<div class="news-feed">
			<div class="news-image" style="background-image: url(/assets/img/login-bg/login-bg-15.jpg)"></div>
			<div class="news-caption">
				<h4 class="caption-title"><b>SIM-KP ITK</b></h4>
				<p>
                    Sistem Informasi Manajemen Kerja Praktik ITK
				</p>
			</div>
		</div>
		<!-- end news-feed -->
		<!-- begin right-content -->
		<div class="right-content">
			<!-- begin register-header -->
			<h1 class="register-header">
				Daftar Mahasiswa
				<small>Silahkan isi form dibawah dengan data yang valid!</small>
			</h1>
			<!-- end register-header -->
			<!-- begin register-content -->
			<div class="register-content">
				<form method="POST" class="margin-bottom-0" action="{{ route('register-mahasiswa-store') }}">
				{{ csrf_field() }}

                    <input type="hidden" id="role" name="role" value="mahasiswa">

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
					<div class="m-t-30 m-b-30 p-b-30">
						Sudah memiliki Akun ? Klik <a href="{{ route('login') }}">Disini</a> untuk Login.
					</div>
					<hr />
					<p class="text-center mb-0">
						&copy; 2021 Institut Teknologi Kalimantan by Naufal Hartanto
					</p>
				</form>
			</div>
			<!-- end register-content -->
		</div>
		<!-- end right-content -->
	</div>
	<!-- end register -->
@endsection
