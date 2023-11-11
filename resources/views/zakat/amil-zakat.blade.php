@extends('layouts-zakat.app')

@section('title', 'Amil Zakat')

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
            <h1>Data Amil Zakat Masjid Al-Hidayah</h1>
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
                                <table class="table-hover table-md table display nowrap" id="table-amil-zakat" style="width: 100%" url="
                                ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Amil</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Jabatan</th>
                                            <th scope="col">Divisi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <!-- <input type="submit" class="btn btn-primary" /> -->
                            <a href="{{ route('export.excelStock') }}" class="btn btn-primary">Print Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="amil-edit" hidden>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="my-2">Amil Zakat Al-Hidayah</h4>
                    </div>
                    <div id="edit-prodi-pres" url="#">
                    <!-- <form class="modal-part" id="modal-edit-stock" action="{{route('edit_stock')}}" method="post"> -->
                    @csrf
                        <div class="card-body">
                            <div class="form-group" >
                                <label>Id Amil</label> 
                                <input type="text" class="form-control" placeholder="Id Amil" name="id" required value="" id="id" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" placeholder="Nama Amil" name="name" id="name"required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email Amil" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="passwordInput" id="password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-eye" id="togglePassword"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
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

    <form class="modal-part" id="modal-add-amil" action="{{route('add_amil')}}" method="post">
        @csrf
        <p>Tambahkan Data <code>Amil Zakat</code> Terbaru</p>
        <div class="form-group" hidden>
            <label>Id Amil</label> 
            <input type="text" class="form-control" placeholder="Id Amil" name="id" required value="{{ $newIdAmil }}" readonly>
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" placeholder="Nama Amil" name="name" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" placeholder="Email Amil" name="email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <div class="input-group">
                <input type="password" class="form-control" placeholder="Password" name="password" id="passwordInput" required>
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-eye" id="togglePassword"></i>
                    </span>
                </div>
            </div>
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
    <script src="../../js/amil.js"></script>
    <script src="../../js/amil-zakat.js"></script>
    <script src="{{ asset('js/page/modules-sweetalert.js') }}"></script>

    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
