@extends('layouts.default')

@section('title', 'Edit Nilai')

@push('css')
    
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
					<h4 class="panel-title">Update Nilai</h4>
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
                <form method="POST" class="margin-bottom-0" action="{{ route('koor.updatenilaiseminar', ['id' => $nilai->id_nilai]) }}">
                        {{ csrf_field() }}

                            <label class="control-label">Dosen Laporan <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('dosen_laporan') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="number" id="dosen_laporan" name="dosen_laporan" class="form-control" placeholder="" min="0" max="100" value="{{ $nilai->dosen_laporan }}" required />
                                    @if ($errors->has('dosen_laporan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dosen_laporan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label">Dosen Poster <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('dosen_poster') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="number" id="dosen_poster" name="dosen_poster" class="form-control" placeholder="" min="0" max="100" value="{{ $nilai->dosen_poster }}" required />
                                    @if ($errors->has('dosen_poster'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dosen_poster') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label">Dosen Presentasi <span class="text-danger">*</span></label>
                            <div class="row row-space-10 {{ $errors->has('dosen_presentasi') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="number" id="dosen_presentasi" name="dosen_presentasi" class="form-control" placeholder="" min="0" max="100" value="{{ $nilai->dosen_presentasi }}" required />
                                    @if ($errors->has('dosen_presentasi'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dosen_presentasi') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="control-label">Revisi/Komentar <span class="text-danger"></span></label>
                            <div class="row row-space-10 {{ $errors->has('revisi_komentar') ? ' has-error' : '' }}">
                                <div class="col-md-12 m-b-15">
                                    <input type="text" id="revisi_komentar" name="revisi_komentar" class="form-control" placeholder="" value="{{ $nilai->revisi_komentar }}" />
                                    @if ($errors->has('revisi_komentar'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('revisi_komentar') }}</strong>
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
   
@endpush