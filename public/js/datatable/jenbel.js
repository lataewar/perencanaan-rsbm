const columns = [
  { data: "cb", name: "cb" },
  {
    data: null,
    sortable: false,
    render: function (data, type, row, meta) {
      return meta.row + meta.settings._iDisplayStart + 1;
    },
  },
  { data: "jb_kode", name: "jb_kode" },
  { data: "jb_name", name: "jb_name" },
  { data: "jb_desc", name: "jb_desc" },
  { data: "aksi", name: "aksi" },
];

const columnDefs = [
  {
    targets: [0, 1, 5],
    orderable: false,
    className: "text-center",
  },
  {
    targets: [2],
    orderable: true,
    className: "text-center",
  },
  {
    targets: [3, 4],
    orderable: true,
  },
];
