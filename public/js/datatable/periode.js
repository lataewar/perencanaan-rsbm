const columns = [
  {
    data: null,
    sortable: false,
    render: function (data, type, row, meta) {
      return meta.row + meta.settings._iDisplayStart + 1;
    },
  },
  {
    data: "periode",
    name: "w_tahun",
  },
  {
    data: "waktu",
    name: "w_date_start",
  },
  {
    data: "status",
  },
  {
    data: "aksi",
  },
];

const columnDefs = [
  {
    targets: [0, 4],
    orderable: false,
    className: "text-center",
  },
  {
    targets: [3],
    orderable: false,
    className: "text-center",
  },
  {
    targets: [1, 2],
    orderable: true,
  },
];
