var url = document.getElementById("main-content").getAttribute('url');
var dataAPI;
var datatable = 0;
refresh('');

function refresh(append) {
  var myHeaders = new Headers();
  myHeaders.append("Cookie", "laravel_session=eyJpdiI6IlRyYUovb3F1UGRJN1FLdlowOWVhOXc9PSIsInZhbHVlIjoiaE9CaFRLV3A3Rk0yclpMd0p4eFRvc3pIMGU5Yk5nS2laVTJ6ejcwNS9UemdUQUg4ZkVFTkYwSm9pejNoanV3cFY5am5kR2ZOWEp4NktOQm5FVFB3TEFIMy83Q2xnc1ErdTFPMXUwdG5lKzJnSGRuYzFtMnNSNFVxRlJCZlg5MzMiLCJtYWMiOiJkMDJmMzkzNDkzNTk2Y2FjNDUyZmU3ODRkM2YxN2RhZjhhYzk3MjAxZTAzODBjM2ZkNWE5M2JlNjQ0ZWZhNzI1IiwidGFnIjoiIn0%3D");

  var requestOptions = {
    method: 'GET',
    headers: myHeaders,
    redirect: 'follow'
  };
    
  fetch("http://127.0.0.1:8000/api/amil", requestOptions)
    .then(response => response.text())
    .then(result => {

      dataAPI = JSON.parse(result)
      console.log(dataAPI);
      if (datatable != 0) {
        $('#table-amil-zakat').dataTable().fnClearTable();
        $('#table-amil-zakat').dataTable().fnAddData(dataAPI.users);
      } else {
        datatable ++      

        $("#table-amil-zakat").DataTable({
          data: dataAPI.users,
          responsive: true,
          pageLength: 10,
          autoWidth: false,
          // order: [[1, "desc"]],
          columnDefs: [
            { targets: [ 5 ], className: 'dt-center' }
          ],
          columns: [
            {
                data: null,
                render: function (data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: "name",
            },
            {
                data: "email",
                // orderable: false,
            },
            {
                data: "role",
                // orderable: false,
            },
            {
                data: "divisi",
                // orderable: false,
            },
            {
              data: 'id',
              render: function (data, type, full, meta) {
                rowww = meta.row
                idpanjang = data
                editbtn = '<button class="btn btn-icon btn-warning m-1" id="editBtn" onclick="editBtn('+ rowww +')" ><i class="fas fa-edit"></i> </button>';
                deletebtn = '<button class="btn btn-icon btn-danger m-1" id="deleteBtn" id="'+data+'" onclick="prodidel('+ rowww +')" ><i class="fas fa-trash"></i> </button>';
                return '<a href=#prodi-prestasi-edit>'+editbtn +deletebtn+'</a>' ;
              },
              orderable: false,
            }
          ],
        });
      }
    })
    .catch(error => console.log('error', error));
  }


  function tutup(){
    document.getElementById('amil-edit').setAttribute('hidden',true);
    sessionStorage.clear();
  }

  function prodidel(id){
    // console.log(urldel);
    console.log(id);
    var id = dataAPI.users[id]
    // var urldel = document.getElementById("table-prodi-pres").getAttribute('url');
    var formdata = new FormData();
    formdata.append("id", id.id);
    // console.log(urldel);
    console.log(id.id);
    // console.log(id_panjang);
    
    var requestOptions = {
      method: 'POST',
      body: formdata,
      redirect: 'follow'
    };


    fetch("http://127.0.0.1:8000/api/delete-amil", requestOptions)
    .then(response => response.text())
    .then(result => {
      // console.log(id)
      console.log(result)
      refresh('')
    })
    .catch(error => console.log('error', error));

  }
  function submit(){
    
    // var link = document.getElementById("edit-prodi-pres").getAttribute('url');
    var formdata = new FormData();
    // var formdata = new FormData();
    formdata.append("id", document.getElementById('id').value);
    formdata.append("nama", document.getElementById('nama').value);
    formdata.append("stock", document.getElementById('stock').value);
    formdata.append("harga_beras", document.getElementById('harga_beras').value);

    var requestOptions = {
    method: 'POST',
    body: formdata,
    redirect: 'follow'
    };

    fetch("http://127.0.0.1:8000/api/update-stock-beras", requestOptions)
  .then(response => response.text())
  .then(result => {
    console.log(result)
    tutup()
    refresh('')
  })
  .catch(error => console.log('error', error));
  
  }

  function editBtn(id) {
    var idbaru = dataAPI.users[id]; // Mengganti 'prodi' menjadi 'stock'
    document.getElementById('amil-edit').removeAttribute('hidden');
    document.getElementById('amil-edit').focus();
    document.getElementById('id').value = idbaru.id;
    document.getElementById('name').value = idbaru.name;
    document.getElementById('email').value = idbaru.email;
  }

  function tahun_terdaftar() {
    var append = '?tahun='+document.getElementById('tahun_terdaftar').value
    refresh(append);
  }

  function templatetahun() {
    var idprodi = document.getElementById('id_obj').value;
    var formdata = new FormData();
    formdata.append("id", idprodi);

    var requestOptions = {
      method: 'POST',
      body: formdata,
      redirect: 'follow'
    };

    fetch("http://localhost:8000/api/prodi-tes/detail", requestOptions)
      .then(response => response.text())
      .then(result => {
        var API = JSON.parse(result)
        var thn = API["prodi"]["binding"][0]["tahun"]
        var bind = API["prodi"]["binding"][0]["bind"]
        var selector = document.getElementById("tahuntemplate");
        if(API["prodi"]["binding"] != null) {
          let tag ='<option>'+thn + '-' + bind+'</option>'
          $("#tahuntemplate").empty();
          $("#tahuntemplate").append('<option>Tahun Terdata</option>');
          $("#tahuntemplate").append(tag);
        }
        
      })
      .catch(error => console.log('error', error));

  }

  function pilihtahun() {
    var idprodi = document.getElementById('id_obj').value;
    var formdata = new FormData();
    formdata.append("id", idprodi);

    var requestOptions = {
      method: 'POST',
      body: formdata,
      redirect: 'follow'
    };

    fetch("http://localhost:8000/api/bind-prodi-tes/detail", requestOptions)
      .then(response => response.text())
      .then(result => {
        var data = JSON.parse(result)
        var bind = data["prodi"]["binding"][0]["bind"]
        document.getElementById('input_prodi').value= bind;
        
        
      })
      .catch(error => console.log('error', error));
  }