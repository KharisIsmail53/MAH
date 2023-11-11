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
            <h1>Data Rekap Transaksi Zakat Masjid Al-Hidayah</h1>
        </div>


        <div id="">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="align-items-left">
                                    <button type="submit" class="btn btn-primary" id="modal-add"><i class="fa-solid fa-print"></i> Print Rekapan Tahunan</button>
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
                            <div class="form-group col-3" style="padding-left: 1px;">
                                <label for="tahunDropdown">Select Year:</label>
                                <select class="form-control" id="tahunDropdown" name="selectedYear">
                                    <option value="" disabled selected>Select Year</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                                <table class="table-hover table-md table display nowrap" id="table-transaksi-zakat" style="width: 100%" url="
                                ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Muzzaki</th>
                                            <th scope="col">Harga Beras</th>
                                            <th scope="col">Jumlah Jiwa</th>
                                            <th scope="col">Jumlah Literan</th>
                                            <th scope="col">Jumlah Uang</th>
                                            <th scope="col">Jenis Zakat</th>
                                            <th scope="col">Jenis Akad</th>
                                            <th scope="col">Tanggal Akad</th>
                                            <th scope="col">Tahun</th>
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
                            <a href="{{ route('download.rekap.excel') }}" class="btn btn-primary" id="exportBtn">Print Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<form class="modal-part" id="modal-print-rekap" action="{{route('export.excel.rekap')}}" method="get">
        @csrf
        <p>Tambahkan Data <code>Transaksi Beras</code> Terbaru</p>
        <div class="form-group">
            <label for="tahunDropdown">Select Year:</label>
            <select class="form-control" id="tahunDropdown" name="selectedYear">
                <option value="" disabled selected>Select Year</option>
                @foreach($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <div class="d-flex justify-content-end">
            <input type="submit" class="btn btn-primary btn-shadow" value="Simpan">
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
    <script src="../../js/rekap.js"></script>
    <script src="../../js/rekap-zakat.js"></script>
    <script src="{{ asset('js/page/modules-sweetalert.js') }}"></script>

    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
