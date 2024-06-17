const setPerPage = function (dom) {
  dom.form.submit();
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
      var form = $(
        '<form action="' +
          urx +
          '" method="post">' +
          '<input type="hidden" name="_method" value="DELETE" />' +
          '<input type="hidden" name="_token" value="' +
          $('meta[name="csrf-token"]').attr("content") +
          '" />' +
          '<input type="hidden" name="destroy" value="' +
          id +
          '" />' +
          "</form>"
      );
      $("body").append(form);
      form.submit();
    }
  });
};
