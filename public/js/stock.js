"use strict";

// var collumn = [];

// document.getElementById("addcollumn").addEventListener("click", addCollumn);

$("#modal-add").fireModal({
  title: 'Tambah Stock',
  body: $("#modal-add-stock"),
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