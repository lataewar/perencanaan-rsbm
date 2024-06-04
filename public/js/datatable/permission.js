const columns = [
  { data: "cb", name: "cb" },
  {
    data: null,
    sortable: false,
    render: function (data, type, row, meta) {
      return meta.row + meta.settings._iDisplayStart + 1;
    },
  },
  { data: "name", name: "name" },
  { data: "aksi", name: "aksi" },
];

const columnDefs = [
  {
    targets: [0, 1, 3],
    orderable: false,
    className: "text-center",
  },
  {
    targets: [2],
    orderable: true,
  },
];
