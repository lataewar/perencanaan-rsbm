const columns = [
  { data: "cb", name: "cb" },
  {
    data: null,
    sortable: false,
    render: function (data, type, row, meta) {
      return meta.row + meta.settings._iDisplayStart + 1;
    },
  },
  {
    data: "unit",
    name: "unit",
  },
  {
    data: "waktu",
    name: "waktu",
  },
  {
    data: "status",
    name: "status",
  },
  {
    data: "total",
    name: "total",
  },
  {
    data: "aksi",
    name: "aksi",
  },
];

const columnDefs = [
  {
    targets: [0, 1, 6],
    orderable: false,
    className: "text-center",
  },
  {
    targets: [2],
    orderable: true,
  },
  {
    targets: [3, 4],
    orderable: true,
    className: "text-center",
  },
  {
    targets: [5],
    orderable: false,
    className: "text-right",
  },
];
