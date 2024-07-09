function selector() {
  var jenbel_url = $("#jenbel_url").val();
  var barang_url = $("#barang_url").val();
  $("#selector1").change(function (e) {
    $.ajax({
      type: "post",
      url: jenbel_url,
      data: {
        jenbel_id: $(this).val(),
        jenbel_lvl: 2,
      },
      dataType: "json",
      success: function (response) {
        if (response.data) {
          $("#selector2").html(response.data);
          $("#selector2").select2({
            placeholder: "Pilih salah satu...",
          });
          $("#selector3").html(
            "<option value='' hidden>Pilih salah satu ...</option>"
          );
          $("#selector4").html(
            "<option value='' hidden>Pilih salah satu ...</option>"
          );
        }
      },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      error: function (xhr, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      },
    });
  });

  $("#selector2").change(function (e) {
    $.ajax({
      type: "post",
      url: jenbel_url,
      data: {
        jenbel_id: $(this).val(),
        jenbel_lvl: 3,
      },
      dataType: "json",
      success: function (response) {
        if (response.data) {
          $("#selector3").html(response.data);
          $("#selector3").select2({
            placeholder: "Pilih salah satu...",
          });
          $("#selector4").html(
            "<option value='' hidden>Pilih salah satu ...</option>"
          );
        }
      },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      error: function (xhr, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      },
    });
  });
  $("#selector3").change(function (e) {
    $.ajax({
      type: "post",
      url: barang_url,
      data: {
        jenbel_id: $(this).val(),
      },
      dataType: "json",
      success: function (response) {
        if (response.data) {
          $("#selector4").html(response.data);
          $("#selector4").select2({
            placeholder: "Pilih salah satu...",
          });
        }
      },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      error: function (xhr, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      },
    });
  });
}
