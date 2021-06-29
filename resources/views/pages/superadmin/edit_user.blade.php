@extends('layouts.default')

@section('title', 'Edit User')

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
					<h4 class="panel-title">Update - User</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
                @if (session('status'))
					<div class="alert alert-info">
						{{ session('status') }}
					</div>
				@endif
				<div class="panel-body">
                <a href="{{ route('sa-user-index') }}" class="btn btn-warning">Kembali</a>
                    <br/><br/>
                <form method="POST" class="margin-bottom-0" action="{{ route('sa-user-update', ['id' => $user->id_users]) }}">
                        {{ csrf_field() }}
        
                            <label class="control-label">Nama <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ $user->name }}" required autofocus />
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <label class="control-label">Username <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('username') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{ $user->username }}" required />
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <label class="control-label">E-mail <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" value="{{ $user->email }}" required />
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <label class="control-label">Role <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('role') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <select class="form-control" name="role" id="role" required>
                                        <option value="">Pilih Role</option>
                                        <option value="mahasiswa" @if($user->role == 'mahasiswa') selected @endif >Mahasiswa</option>
                                        <option value="dosen" @if($user->role == 'dosen') selected @endif >Dosen</option>
                                        <option value="koordinator" @if($user->role == 'koordinator') selected @endif >Koordinator</option>
                                        <option value="tendik" @if($user->role == 'tendik') selected @endif >Tendik</option>
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <label class="control-label">Status <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('isActive') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <select class="form-control" name="isActive" id="isActive" required>
                                        <option value="">Pilih Status</option>
                                        <option value="0" @if($user->isActive == 0) selected @endif >Tidak Aktif</option>
                                        <option value="1" @if($user->isActive == 1) selected @endif >Aktif</option>
                                        
                                    </select>
                                    @if ($errors->has('isActive'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('isActive') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <label class="control-label">Password 
                            </label>
                            <div class="row row-space-10 {{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="password" name="password" class="form-control" placeholder="Password" value="" />
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
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