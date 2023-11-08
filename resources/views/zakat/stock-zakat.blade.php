@extends('layouts-zakat.app')

@section('title', 'Stock Beras')

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
            <h1>Data Kuota Program Studi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Seleksi Prestasi</a></div>
                <div class="breadcrumb-item"><a href="#">Program Studi</a></div>
                <div class="breadcrumb-item">Data Kuota Program Studi</div>
            </div>
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
                                <table class="table-hover table-md table display nowrap" id="table-stock-beras" style="width: 100%" url="
                                ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Harga Beras</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Tanggal Masuk</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <input type="submit" class="btn btn-primary" />
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
                                    <input class="btn btn-danger ml-2"type="button" value="Close" onclick="tutup()">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form class="modal-part" id="modal-add-stock" action="{{route('add_stock')}}" method="post">
        @csrf
        <p>Tambahkan Data <code>Stock Beras</code> Terbaru</p>
        <div class="form-group">
            <label>Id Beras</label> 
            <input type="number" class="form-control" placeholder="Id Beras" name="id" required>
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" placeholder="Keterangan Stock Beras" name="nama" required>
        </div>
        <div class="form-group">
            <label>Harga Beras</label>
            <input type="number" class="form-control" placeholder="Harga Beras" name="harga_beras" required>
        </div>
        <div class="form-group">
            <label>Stock</label>
            <input type="number" class="form-control" placeholder="Stock Beras (Isi 66 Jika 50KG Beras)" name="stock" required>
        </div>
        <div class="d-flex justify-content-end">
            <input type="submit" class="btn btn-primary btn-shadow" value="Tambah">
        </div>
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

    <!-- Page Specific JS File -->
    <script src="../../js/table.js"></script>
    <script src="../../js/style.js"></script>
    <script src="../../js/stock.js"></script>
    <script src="../../js/stock-beras.js"></script>
    <script src="{{ asset('js/page/modules-sweetalert.js') }}"></script>

    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
