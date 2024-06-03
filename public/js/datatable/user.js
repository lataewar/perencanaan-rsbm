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
  { data: "email", name: "email" },
  { data: "role", name: "role_id" },
  { data: "dibuat", name: "dibuat" },
  { data: "aksi", name: "aksi" },
];

const columnDefs = [
  {
    targets: [0, 1, 6],
    orderable: false,
    className: "text-center",
  },
  {
    targets: [4],
    orderable: true,
    className: "text-center",
  },
  {
    targets: [2, 3, 5],
    orderable: true,
  },
];
