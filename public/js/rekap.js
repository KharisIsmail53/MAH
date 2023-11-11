"use strict";

// var collumn = [];
// document.getElementById("addcollumn").addEventListener("click", addCollumn);

$("#modal-add").fireModal({
  title: 'Print Rekap',
  body: $("#modal-print-rekap"),
  center: true,
  footerClass: 'bg-whitesmoke',
  
});


function editBtn(id){
  $('#row-'+id).hide();
  $('#row-edit-'+id).show();
}

function closeButton(id){
  $('#row-'+id).show();
  $('#row-edit-'+id).hide();
}

$("#modal-print-rekap").submit(function (event) {
  // Get the form element
  event.preventDefault();

    // Perform the form submission via AJAX
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function (response) {
            // Close the modal
            $("#modal-add").modal('hide');

            // Reload the page
            location.reload();
        }
    });
});