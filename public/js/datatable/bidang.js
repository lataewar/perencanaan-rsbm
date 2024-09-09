const columns = [
  {
    data: null,
    sortable: false,
    render: function (data, type, row, meta) {
      return meta.row + meta.settings._iDisplayStart + 1;
    },
  },
  { data: "b_name", name: "b_name" },
  { data: "b_kode", name: "b_kode" },
  { data: "b_desc", name: "b_desc" },
  { data: "units_count", name: "units_count" },
  { data: "aksi", name: "aksi" },
];

const columnDefs = [
  {
    targets: [0, 5],
    orderable: false,
    className: "text-center",
  },
  {
    targets: [1, 2, 3, 4],
    orderable: true,
  },
];
