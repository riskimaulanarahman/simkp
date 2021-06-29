@extends('layouts.default')

@section('title', 'Edit Mitra KP')

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
					<h4 class="panel-title">Update - Mitra KP</h4>
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
                <a href="{{ url()->previous() }}" class="btn btn-warning">Kembali</a>
                    <br/><br/>
                <form method="POST" class="margin-bottom-0" action="{{ route('tendik.mitra-update', ['id' => $mitrakp->id_mitrakp]) }}">
                        {{ csrf_field() }}
        
                            <label class="control-label">Nama mitra <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('nama_mitra') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="nama_mitra" name="nama_mitra" class="form-control" value="{{ $mitrakp->nama_mitra }}" required autofocus />
                                    @if ($errors->has('nama_mitra'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nama_mitra') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label">alamat mitra <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('alamat_mitra') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="alamat_mitra" name="alamat_mitra" class="form-control" value="{{ $mitrakp->alamat_mitra }}" required autofocus />
                                    @if ($errors->has('alamat_mitra'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('alamat_mitra') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label">jenis bidang <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('jenis_bidang') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="jenis_bidang" name="jenis_bidang" class="form-control" value="{{ $mitrakp->jenis_bidang }}" required autofocus />
                                    @if ($errors->has('jenis_bidang'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('jenis_bidang') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label">periode kp <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('periodekp') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="datepicker-autoClose" name="periodekp" class="form-control" value="{{ $mitrakp->periodekp }}" required autofocus />
                                    @if ($errors->has('periodekp'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('periodekp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label">periode kp <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('endperiode') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="datepicker-autoClose2" name="endperiode" class="form-control" value="{{ $mitrakp->endperiode }}" required autofocus />
                                    @if ($errors->has('endperiode'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('endperiode') }}</strong>
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