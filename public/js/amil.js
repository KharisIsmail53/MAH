"use strict";

// var collumn = [];

// document.getElementById("addcollumn").addEventListener("click", addCollumn);

$("#modal-add").fireModal({
  title: 'Tambah Amil Zakat',
  body: $("#modal-add-amil"),
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

const passwordInput = document.getElementById('passwordInput');
    const togglePassword = document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.classList.toggle('fa-eye-slash');
    });