const setPerPage = function (dom) {
  dom.form.submit();
};

const destroy_pivot = function (belanja_id, pivot_id, name, usulan_id) {
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
          '<input type="hidden" name="pivot_id" value="' +
          pivot_id +
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

const destroy_item = function (id, name) {
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

const swalProps = {
  text: "Konfirmasi aksi anda.",
  icon: "info",
  showCancelButton: true,
  buttonsStyling: false,
  confirmButtonText: "Konfirmasi",
  cancelButtonText: "Batal",
  customClass: {
    confirmButton: "btn font-weight-bold btn-primary",
    cancelButton: "btn font-weight-bold btn-default",
  },
};

const send = function (id, name) {
  Swal.fire(swalProps).then((result) => {
    if (result.isConfirmed) {
      const urx_send = $("#urx_send").val();
      var form = $(
        '<form action="' +
          urx_send +
          '" method="post">' +
          '<input type="hidden" name="_token" value="' +
          $('meta[name="csrf-token"]').attr("content") +
          '" />' +
          '<input type="hidden" name="id" value="' +
          id +
          '" />' +
          "</form>"
      );
      $("body").append(form);
      form.submit();
    }
  });
};

const accept = function (id, name) {
  Swal.fire(swalProps).then((result) => {
    if (result.isConfirmed) {
      const urx_accept = $("#urx_accept").val();
      var form = $(
        '<form action="' +
          urx_accept +
          '" method="post">' +
          '<input type="hidden" name="_token" value="' +
          $('meta[name="csrf-token"]').attr("content") +
          '" />' +
          '<input type="hidden" name="id" value="' +
          id +
          '" />' +
          "</form>"
      );
      $("body").append(form);
      form.submit();
    }
  });
};

const validate = function (id, name) {
  Swal.fire(swalProps).then((result) => {
    if (result.isConfirmed) {
      const urx_accept = $("#urx_validate").val();
      var form = $(
        '<form action="' +
          urx_accept +
          '" method="post">' +
          '<input type="hidden" name="_token" value="' +
          $('meta[name="csrf-token"]').attr("content") +
          '" />' +
          '<input type="hidden" name="id" value="' +
          id +
          '" />' +
          "</form>"
      );
      $("body").append(form);
      form.submit();
    }
  });
};

const reject = function (id, name) {
  Swal.fire(swalProps).then((result) => {
    if (result.isConfirmed) {
      const urx_reject = $("#urx_reject").val();
      var form = $(
        '<form action="' +
          urx_reject +
          '" method="post">' +
          '<input type="hidden" name="_token" value="' +
          $('meta[name="csrf-token"]').attr("content") +
          '" />' +
          '<input type="hidden" name="id" value="' +
          id +
          '" />' +
          "</form>"
      );
      $("body").append(form);
      form.submit();
    }
  });
};
