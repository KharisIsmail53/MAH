@extends('layouts-zakat.app')

@section('title', 'Transaksi Beras')

@push('style')
<!-- CSS Libraries -->
{{-- <link rel="stylesheet"
        href="assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css"> --}}
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />


@endpush

@section('main')
<div class="main-content" id="main-content" url="#">
    <section class="section">
        <div class="section-header">
            <h1>Data Transaksi Zakat Masjid Al-Hidayah</h1>
        </div>


        <div id="">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="align-items-left">
                                    <button type="submit" class="btn btn-primary" id="modal-add"><i class="fas fa-plus"></i> Add</button>
                                </div>

                                <div class="align-items-right">
                                    
                                </div>
                            </div>
                            <br>

                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close"
                                            data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close"
                                            data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        {{ $error }}
                                    </div>
                                </div>
                                @endforeach
                            @endif

                            <br>
                            <div class="">
                                <table class="table-hover table-md table display nowrap" id="table-transaksi-zakat" style="width: 100%" url="
                                ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Id Akad</th>
                                            <th scope="col">Nama Muzzaki</th>
                                            <th scope="col">Harga Beras</th>
                                            <th scope="col">Jumlah Jiwa</th>
                                            <th scope="col">Jumlah Literan</th>
                                            <th scope="col">Jumlah Uang</th>
                                            <th scope="col">Jenis Zakat</th>
                                            <th scope="col">Jenis Akad</th>
                                            <th scope="col">Tanggal Akad</th>
                                            <!-- <th scope="col">Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <!-- <input type="submit" class="btn btn-primary" value="Print Laporan"/> -->
                            <!-- <input type="submit" class="btn btn-primary" id="exportExcelBtn" value="Print Laporan"/> -->
                            <a href="{{ route('export.excel') }}" class="btn btn-primary">Print Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="stock-edit" hidden>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="my-2">Stock Beras Al-Hidayah</h4>
                    </div>
                    <div id="edit-prodi-pres" url="#">
                    <!-- <form class="modal-part" id="modal-edit-stock" action="{{route('edit_stock')}}" method="post"> -->
                    @csrf
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">#</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" id="id" name="id" class="form-control"readonly/>
                                    <!-- <input type="text" id="id_obj" name="id_obj" class="form-control" hidden/> -->
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" id="nama" name="nama" class="form-control" required/>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga Beras</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" id="harga_beras" name="harga_beras" class="form-control" required/>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Stock</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" id="stock" name="stock" class="form-control" placeholder="Stock Beras" required/>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <input class="btn btn-success" type="button" onclick="submit()" value="Submit">
                                   <!-- <input type="submit" class="btn btn-primary btn-shadow" value="Tambah"> -->
                                    <input class="btn btn-danger ml-2"type="button" value="Close" onclick="tutup()">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form class="modal-part" id="modal-add-stock" action="{{route('add-transaksi-zakat')}}" method="post">
        @csrf
        <p>Tambahkan Data <code>Stock Beras</code> Terbaru</p>
        <div class="form-group">
            <label>Id Akad</label> 
            <input type="text" class="form-control" placeholder="Id Akad" name="id_akad" required>
        </div>
        <div class="form-group">
            <label>Nama Muzzaki</label>
            <input type="text" class="form-control" placeholder="Nama Muzzaki" name="nama" required>
        </div>
        <div class="form-group" hidden >
            <label>Nama Amil</label>
            <input type="text" class="form-control" placeholder="Nama Amil" name="nama_amil" required value="{{ session('user_name') }}" readonly>
        </div>
        <div class="form-group" >
            <label>Jenis Zakat</label>
            <select class="form-control" name="jenis_zakat" required>
                <option value="" selected disabled>Pilih Jenis Zakat</option>
                <option value="Fidyah">Fidyah</option>
                <option value="Fitrah">Fitrah</option>
            </select>
        </div>
        <div class="form-group" hidden id="jenis_akad">
            <label>Jenis Akad</label>
            <select class="form-control" name="jenis_akad" required>
                <option value="" selected disabled>Pilih Jenis Akad</option>
                <option value="Tunai">Tunai</option>
                
            </select>
        </div>
        <div class="form-group" hidden id="harga_berass">
        <label>Harga Beras</label>
            <select class="form-control" name="harga_beras" >
                <option value="" selected disabled>Pilih Harga Beras</option>
                @foreach($stock_beras as $item)
                    <option value="{{ $item->harga_beras }}">{{ $item->harga_beras }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" hidden id="jumlah_sembako">
            <label>Jumlah Sembako</label>
            <input type="text" class="form-control" placeholder="Jumlah Sembako yang dimakan" name="jumlah_sembako" >
        </div>
        <div class="form-group" hidden id="jumlah_hari">
            <label>Jumlah Hari</label>
            <input type="text" class="form-control" placeholder="Jumlah hari yang dibayarkan fidyah" name="jumlah_hari" >
        </div>
        <div class="form-group" hidden id="jumlah_keluarga">
            <label>Jumlah Keluarga</label>
            <input type="text" class="form-control" placeholder="Jumlah Kepala yang dizakatkan / difidyahkan" name="jumlah_keluarga" >
        </div>
        <div class="form-group"  id="jumlah_literan">
            <label>Jumlah Literan</label>
            <input type="text" class="form-control" placeholder="Jumlah Literan" name="jumlah_literan">
        </div>
        <div class="form-group" hidden id="jumlah_uang">
            <label>Jumlah Uang</label>
            <input type="text" class="form-control" placeholder="Jumlah Uang yang dibayarkan" name="jumlah_uang" >
        </div>
        <div class="d-flex justify-content-end">
            <input type="submit" class="btn btn-primary btn-shadow" value="Tambah">
    </form>

    
</div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

    <!-- Page Specific JS File -->
    <script src="../../js/table.js"></script>
    <script src="../../js/style.js"></script>
    <script src="../../js/transaksi.js"></script>
    <script src="../../js/transaksi-zakat.js"></script>
    <script src="{{ asset('js/page/modules-sweetalert.js') }}"></script>

    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
