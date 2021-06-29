@extends('layouts.default')

@section('title', 'Tambah Prodi')

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
					<h4 class="panel-title">Tambah - Program Studi</h4>
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
                <form method="POST" class="margin-bottom-0" action="{{ route('sa-prodi-store') }}">
                        {{ csrf_field() }}
                            
                            <label class="control-label ldosen">Nama Jurusan <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('nama_jurusan') ? ' has-error' : '' }} ldosen">
                                <div class="col-md-12 m-b-15">
                                    <select class="form-control" name="nama_jurusan" id="dosens2" required>
                                        <option value="">- Select -</option>
                                        @foreach($jurusan as $id => $jurusans )
                                        <option value="{{ $id }}">{{ $jurusans }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('nama_jurusan'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('nama_jurusan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label ldosen">Nama Program Studi <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('nama_prodi') ? ' has-error' : '' }} ldosen">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="nama_prodi" name="nama_prodi" class="form-control" placeholder="Nama Program Studi" value="{{ old('nama_prodi') }}"  />
                                    @if ($errors->has('nama_prodi'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('nama_prodi') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="register-buttons">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">Save</button>
                            </div>

                            <hr />

                </form>
                <a href="{{ route('sa-prodi-index') }}" class="btn btn-danger">Kembali</a>
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