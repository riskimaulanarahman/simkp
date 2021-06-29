@extends('layouts.empty')

@section('title', 'Cek Jadwal Seminar')

@push('css')
	<link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')

<div class="p-15">


	<!-- begin panel -->
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Cek Jadwal Seminar Hasil KP</h4>
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			</div>
		</div>
        <form action="{{ route('home.cekjadwalseminar') }}" method="GET" class="form-inline">
            <select style="cursor:pointer;" class="form-control m-5" id="tag_select" name="prodi">
                <option value="">- Pilih Prodi -</option>
                @foreach($prodi as $id => $prodis )
                    <option value="{{ $id }}">{{ $prodis }}</option>
                @endforeach
            </select>
            <input class="btn btn-info m-5" type="submit" value="Cari Data"/>
        </form>
        
		<div class="panel-body">
            <table id="data-table-responsive4" class="table table-striped table-bordered table-td-valign-middle">
                <thead>
                    <tr>
                        <th width="1%" class="text-nowrap">ID</th>
                        <th class="text-nowrap">NIM</th>
                        <th class="text-nowrap">Nama</th>
                        <th class="text-nowrap">Ruang Seminar</th>
                        <th class="text-nowrap">Tanggal Seminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1 ?>
                    @foreach($jadwal as $p)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td>{{ $p->mahasiswa->nim }}</td>
                        <td>{{ $p->mahasiswa->nama }}</td>
                        <td><button class="btn btn-success"> {{$p->ruang->nama_ruang}} </button> </td>
                        <td>{{ $p->tanggal_sidang }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
		</div>
	</div>
	<!-- end panel -->

</div>

@endsection

@push('scripts')
	<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="/assets/js/demo/table-manage-responsive.demo.js"></script>
@endpush