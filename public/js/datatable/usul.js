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
    data: "ul_name",
    name: "ul_name",
  },
  {
    data: "ul_prise",
    name: "ul_prise",
  },
  {
    data: "ul_qty",
    name: "ul_qty",
  },
  {
    data: "total",
  },
  {
    data: "ul_desc",
    name: "ul_desc",
  },
  {
    data: "ruang",
    name: "ruangan.r_name",
  },
  {
    data: "aksi",
    name: "aksi",
  },
];

const columnDefs = [
  {
    targets: [0, 1, 8],
    orderable: false,
    className: "text-center",
  },
  {
    targets: [2, 6, 7],
    orderable: true,
  },
  {
    targets: [3, 4, 5],
    orderable: false,
    className: "text-right",
  },
];
