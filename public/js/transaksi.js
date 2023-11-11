"use strict";

// var collumn = [];
// document.getElementById("addcollumn").addEventListener("click", addCollumn);

$("#modal-add").fireModal({
  title: 'Tambah Stock',
  body: $("#modal-add-transaksi"),
  center: true,
  footerClass: 'bg-whitesmoke',
  autoFocus: true,
  
});


function editBtn(id){
  $('#row-'+id).hide();
  $('#row-edit-'+id).show();
}

function closeButton(id){
  $('#row-'+id).show();
  $('#row-edit-'+id).hide();
}

document.addEventListener('DOMContentLoaded', function () {
  var hargaBerasSelect = document.querySelector('select[name="harga_beras"]');
  var jumlahKeluargaInput = document.querySelector('input[name="jumlah_keluarga"]');
  var jumlahUangInput = document.querySelector('input[name="jumlah_uang"]');

  // Fungsi untuk menghitung jumlah uang berdasarkan harga beras dan jumlah keluarga
  function hitungJumlahUang() {
      var hargaBeras = parseFloat(hargaBerasSelect.value);
      var jumlahKeluarga = parseFloat(jumlahKeluargaInput.value);

      if (!isNaN(hargaBeras) || !isNaN(jumlahKeluarga)) {
          var jumlahUang = hargaBeras * jumlahKeluarga * 3.5;
          jumlahUangInput.value = jumlahUang.toFixed(2);
      }
      else{
        jumlahUangInput.value='';
      }
  }

  // Menambahkan event listener untuk perubahan pada select harga beras dan input jumlah keluarga
  hargaBerasSelect.addEventListener('change', hitungJumlahUang);
  jumlahKeluargaInput.addEventListener('input', hitungJumlahUang);
});

document.addEventListener('DOMContentLoaded', function () {
  var hargaBerasSelect = document.querySelector('select[name="harga_beras"]');
  var jumlahKeluargaInput = document.querySelector('input[name="jumlah_keluarga"]');
  var jumlahLiterInput = document.querySelector('input[name="jumlah_literan"]');

  // Fungsi untuk menghitung jumlah uang berdasarkan harga beras dan jumlah keluarga
  function hitungJumlahLiter() {
      var jumlahKeluarga = parseFloat(jumlahKeluargaInput.value);

      if (!isNaN(jumlahKeluarga)) {
          var jumlahLiter = jumlahKeluarga * 3.5;
          jumlahLiterInput.value = jumlahLiter.toFixed(2);
      }
      else{
        jumlahLiterInput.value = '';
      }
  }

  // Menambahkan event listener untuk perubahan pada select harga beras dan input jumlah keluarga
  hargaBerasSelect.addEventListener('change', hitungJumlahLiter);
  jumlahKeluargaInput.addEventListener('input', hitungJumlahLiter);
});

document.addEventListener('DOMContentLoaded', function () {
  var jumlahHariInput = document.querySelector('input[name="jumlah_hari"]');
  var jumlahSembakoInput = document.querySelector('input[name="jumlah_sembako"]');
  var jumlahKeluargaInput = document.querySelector('input[name="jumlah_keluarga"]');
  var jumlahUangInput = document.querySelector('input[name="jumlah_uang"]');

  // Function to calculate jumlah_uang
  function calculateJumlahUang() {
      var jumlahHari = parseFloat(jumlahHariInput.value) || 0;
      var jumlahSembako = parseFloat(jumlahSembakoInput.value) || 0;
      var jumlahKeluarga = parseFloat(jumlahKeluargaInput.value) || 0;

      // Perform the calculation
      var result = jumlahHari * jumlahSembako * jumlahKeluarga;

      // Display the result in the jumlah_uang input
      jumlahUangInput.value = result.toFixed(2);
  }

  // Add event listeners to the input fields
  jumlahHariInput.addEventListener('input', calculateJumlahUang);
  jumlahSembakoInput.addEventListener('input', calculateJumlahUang);
  // jumlahKeluargaInput.addEventListener('input', calculateJumlahUang);
});


document.addEventListener('DOMContentLoaded', function () {
  var jenisZakatSelect = document.querySelector('select[name="jenis_zakat"]');
  var jenisAkadSelect = document.querySelector('select[name="jenis_akad"]');
  var hargaBerasSelect = document.querySelector('select[name="harga_beras"]');
  var jumlahKeluargaInput = document.querySelector('input[name="jumlah_keluarga"]');
  var jumlahLiteranInput = document.querySelector('input[name="jumlah_literan"]');
  var jumlahUangInput = document.querySelector('input[name="jumlah_uang"]');
  // var jenisAkadBerasOption = document.querySelector('select[name="jenis_akad"] option[value="Beras"]');
  var berasOptionAdded = false;
  // Fungsi untuk menangani perubahan pada jenis zakat
  function handleJenisZakatChange() {
      var selectedJenisZakat = jenisZakatSelect.value;
      var selectedJenisAkad = jenisAkadSelect.value;
      // Reset nilai pada jenis akad, harga beras, jumlah keluarga, jumlah literan, dan jumlah uang
      jenisAkadSelect.value = '';
      hargaBerasSelect.value = '';
      jumlahKeluargaInput.value = '';
      jumlahLiteranInput.value = '';
      jumlahUangInput.value = '';

      // Mengatur ketersediaan dan nilai berdasarkan jenis zakat
      if (selectedJenisZakat === 'Fidyah') {
          document.getElementById('jenis_akad').removeAttribute('hidden');
          document.getElementById('harga_berass').setAttribute('hidden', true);
          document.getElementById('jumlah_keluarga').setAttribute('hidden', true);
          document.getElementById('jumlah_literan').setAttribute('hidden', true);
          document.getElementById('jumlah_uang').setAttribute('hidden', true);
          document.getElementById('jumlah_sembako').setAttribute('hidden', true);
          document.getElementById('jumlah_hari').setAttribute('hidden', true);

          // jenisAkadSelect.removeChild(jenisAkadBerasOption);
          removeBerasOption();
      } else if (selectedJenisZakat === 'Fitrah') {
          document.getElementById('jenis_akad').removeAttribute('hidden');
          document.getElementById('harga_berass').setAttribute('hidden', true);
          document.getElementById('jumlah_keluarga').setAttribute('hidden', true);
          document.getElementById('jumlah_literan').setAttribute('hidden', true);
          document.getElementById('jumlah_uang').setAttribute('hidden', true);
          document.getElementById('jumlah_sembako').setAttribute('hidden', true);
          document.getElementById('jumlah_hari').setAttribute('hidden', true);
          addBerasOption();
      } else {
          document.getElementById('jenis_akad').setAttribute('hidden', true);
          document.getElementById('harga_berass').setAttribute('hidden', true);
          document.getElementById('jumlah_keluarga').setAttribute('hidden', true);
          document.getElementById('jumlah_literan').setAttribute('hidden', true);
          document.getElementById('jumlah_sembako').setAttribute('hidden', true);
          document.getElementById('jumlah_hari').setAttribute('hidden', true);
      }
  }

  function addBerasOption() {
    if (!berasOptionAdded && jenisAkadSelect) {
        jenisAkadSelect.add(new Option('Beras', 'Beras'));
        berasOptionAdded = true;
    }
  }

  // Fungsi untuk menghapus opsi "Beras" dari dropdown
  function removeBerasOption() {
      if (berasOptionAdded && jenisAkadSelect) {
          var berasOption = jenisAkadSelect.querySelector('option[value="Beras"]');
          if (berasOption) {
              jenisAkadSelect.removeChild(berasOption);
          }
          berasOptionAdded = false;
      }
  }

  function jenisAkad(){
    var selectedJenisZakat = jenisZakatSelect.value;
    var selectedJenisAkad = jenisAkadSelect.value;
    if (selectedJenisAkad === 'Tunai' && selectedJenisZakat === 'Fitrah'){
      document.getElementById('harga_berass').removeAttribute('hidden');
      document.getElementById('jumlah_keluarga').removeAttribute('hidden');
      // document.getElementById('jumlah_literan').removeAttribute('hidden');
      document.getElementById('jumlah_uang').removeAttribute('hidden');
      document.getElementById('jumlah_sembako').setAttribute('hidden', true);
      document.getElementById('jumlah_hari').setAttribute('hidden', true);
      document.getElementById('jumlah_literan').setAttribute('hidden', true);
      
    }else if(selectedJenisAkad === 'Beras' && selectedJenisZakat === 'Fitrah'){
      // document.getElementById('harga_berass').removeAttribute('hidden');
      document.getElementById('jumlah_keluarga').removeAttribute('hidden');
      document.getElementById('jumlah_literan').removeAttribute('hidden');
      // document.getElementById('jumlah_uang').removeAttribute('hidden');
      document.getElementById('harga_berass').setAttribute('hidden', true);
      document.getElementById('jumlah_sembako').setAttribute('hidden', true);
      document.getElementById('jumlah_hari').setAttribute('hidden', true);
      document.getElementById('jumlah_uang').setAttribute('hidden', true);
    }else if(selectedJenisAkad === 'Tunai' && selectedJenisZakat === 'Fidyah'){
      // document.getElementById('harga_berass').removeAttribute('hidden');
      document.getElementById('jumlah_keluarga').removeAttribute('hidden');
      // document.getElementById('jumlah_literan').removeAttribute('hidden');
      document.getElementById('jumlah_uang').removeAttribute('hidden');
      document.getElementById('jumlah_sembako').removeAttribute('hidden');
      document.getElementById('jumlah_hari').removeAttribute('hidden');
      document.getElementById('harga_berass').setAttribute('hidden', true);
      document.getElementById('jumlah_literan').setAttribute('hidden', true);
    }
    else{
      document.getElementById('harga_berass').setAttribute('hidden', true);
      document.getElementById('jumlah_keluarga').setAttribute('hidden', true);
      document.getElementById('jumlah_literan').setAttribute('hidden', true);
      document.getElementById('jumlah_sembako').setAttribute('hidden', true);
      document.getElementById('jumlah_uang').setAttribute('hidden', true);
      document.getElementById('jumlah_hari').setAttribute('hidden', true);
    }
  }

  // Menambahkan event listener untuk perubahan pada jenis zakat
  jenisZakatSelect.addEventListener('change', handleJenisZakatChange);
  jenisAkadSelect.addEventListener('change', jenisAkad);

  jenisAkad();
});

document.addEventListener('DOMContentLoaded', function () {
  // Assuming your Laravel route is named 'export.excel'
  var exportExcelUrl = "{{ route('export.excel') }}";

  // Get the "Test" button element by its id
  var exportExcelBtn = document.getElementById('exportExcelBtn');

  // Attach a click event listener to the "Test" button
  exportExcelBtn.addEventListener('click', function () {
      // Redirect to the /export-excel route
      window.location.href = exportExcelUrl;
  });
});