const destroy = function (belanja_id, barang_id, name, usulan_id) {
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
          '<input type="hidden" name="barang_id" value="' +
          barang_id +
          '" />' +
          '<input type="hidden" name="belanja_id" value="' +
          belanja_id +
          '" />' +
          '<input type="hidden" name="usulan_id" value="' +
          usulan_id +
          '" />' +
          "</form>"
      );
      $("body").append(form);
      form.submit();
    }
  });
};
