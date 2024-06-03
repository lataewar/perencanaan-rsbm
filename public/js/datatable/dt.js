let showData = function () {
  // $("#Datatable").dataTable().fnDestroy();
  $("#Datatable").DataTable({
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: urx + "/datatable",
      type: "POST",
      complete: function () {
        toggleMBD();
      },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      },
    },
    columnDefs,
    columns,
    responsive: true,
    bDestroy: true,
  });
};

const destroy = function (id, name) {
  Swal.fire({
    title: `Apakah anda yakin?`,
    text: `Menghapus '${name}'`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Hapus",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      ajaxCall(
        urx + "/" + id,
        "delete",
        { id, name },
        "json",
        function () {
          loader("show");
        },
        function () {
          loader("hide");
        },
        function (response) {
          succeedRes(response);
        }
      );
    }
  });
};

const multiplydelete = function () {
  $(document).on("click", "#check-all", function (e) {
    if ($(this).is(":checked")) {
      $(".check-id").prop("checked", true).change();
    } else {
      $(".check-id").prop("checked", false).change();
    }
  });

  $(document).on("change", ".check-id", function (e) {
    if ($(this).is(":checked")) {
      $(this).closest("tr").addClass("tr-active");
    } else {
      $(this).closest("tr").removeClass("tr-active");
    }
    toggleMBD();
  });

  $(document).on("click", ".btn-multdelete", function (e) {
    e.preventDefault();
    let datas = $(".check-id:checked");
    if (datas.length === 0) {
      sweetAlert("Perhatian", "Belum ada data yang dipilih.", "error");
    } else {
      Swal.fire({
        title: `Apakah anda yakin?`,
        text: `Menghapus ${datas.length} data`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
      }).then((result) => {
        if (result.isConfirmed) {
          ajaxCall(
            $("#form-multdelete").attr("action"),
            "post",
            $("#form-multdelete").serialize(),
            "json",
            function () {
              loader("show");
            },
            function () {
              loader("hide");
            },
            function (response) {
              succeedRes(response);
            }
          );
        }
      });
    }
  });
};

$(document).ready(function () {
  showData();
  multiplydelete();
});
