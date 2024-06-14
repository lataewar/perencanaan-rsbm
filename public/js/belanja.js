$(document).on("submit", ".deleteBelanja", function (e) {
  e.preventDefault();
  const jb_name = $(this).find('input[name="jb_name"]').val();
  Swal.fire({
    title: `Apakah anda yakin?`,
    text: `Menghapus '${jb_name}'`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Hapus",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      e.currentTarget.submit();
    }
  });
});
