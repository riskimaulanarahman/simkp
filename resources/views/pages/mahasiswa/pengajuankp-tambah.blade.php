@extends('layouts.default')

@section('title', 'Add Pengajuan')

@push('css')
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="/assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="/assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
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
					<h4 class="panel-title">Add</h4>
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
                <a href="{{ route('mahasiswa.pengajuan') }}" class="btn btn-warning">Kembali</a>
                    <br/><br/>
                <form method="POST" class="margin-bottom-0"  enctype="multipart/form-data" action="{{ route('mahasiswa.pengajuan.store') }}">
                        {{ csrf_field() }}
        
                            <label class="control-label">Nama Mitra <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('nama_mitra') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="nama_mitra" name="nama_mitra" class="form-control" placeholder="" required autofocus />
                                    @if ($errors->has('nama_mitra'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('nama_mitra') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label">Alamat Mitra <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('alamat_mitra') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="alamat_mitra" name="alamat_mitra" class="form-control" placeholder="" required autofocus />
                                    @if ($errors->has('alamat_mitra'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('alamat_mitra') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label">Jenis Bidang <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('jenis_bidang') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="jenis_bidang" name="jenis_bidang" class="form-control" placeholder="" required autofocus />
                                    @if ($errors->has('jenis_bidang'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('jenis_bidang') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label">Mulai KP <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('periodekp') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" class="form-control" name="periodekp" id="datepicker-autoClose" placeholder="" required autofocus/>
                                   
                                    @if ($errors->has('periodekp'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('periodekp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label">Selesai KP <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('endperiode') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" class="form-control" name="endperiode" id="datepicker-autoClose2" placeholder="" required autofocus/>
                                   
                                    @if ($errors->has('endperiode'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('endperiode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label ldosen">Transkip Nilai <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('file') ? ' has-error' : '' }} ldosen">
                                <div class="col-md-12 m-b-15">
                                    <input type="file" id="file" name="file" class="form-control" value="{{ old('file') }}" required autofocus/>
                                    @if ($errors->has('file'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('file') }}</strong>
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
				
		</div>
		<!-- end col-10 -->
	</div>
	<!-- end row -->
@endsection

@push('scripts')
    <script src="/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="/assets/plugins/moment/moment.js"></script>
	<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="/assets/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<script src="/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="/assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
	<script src="/assets/plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="/assets/plugins/tag-it/js/tag-it.min.js"></script>
	<script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="/assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="/assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="/assets/plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
	<script src="/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="/assets/plugins/clipboard/dist/clipboard.min.js"></script>
	<script src="/assets/js/demo/form-plugins.demo.js"></script>
	<script src="/assets/js/demo/table-manage-responsive.demo.js"></script>
@endpush