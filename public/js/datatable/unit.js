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
    data: "sk_name",
    name: "sk_name",
  },
  {
    data: "sk_kode",
    name: "sk_kode",
  },
  {
    data: "sk_desc",
    name: "sk_desc",
  },
  {
    data: "aksi",
    name: "aksi",
  },
];

const columnDefs = [
  {
    targets: [0, 1, 5],
    orderable: false,
    className: "text-center",
  },
  {
    targets: [3],
    orderable: true,
    className: "text-center",
  },
  {
    targets: [2, 4],
    orderable: true,
  },
];
