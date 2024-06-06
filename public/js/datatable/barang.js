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
    data: "br_kode",
    name: "br_kode",
  },
  {
    data: "br_name",
    name: "br_name",
  },
  {
    data: "br_satuan",
    name: "br_satuan",
  },
  {
    data: "br_desc",
    name: "br_desc",
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
    targets: [2, 4],
    orderable: true,
    className: "text-center",
  },
  {
    targets: [3, 5],
    orderable: true,
  },
];
