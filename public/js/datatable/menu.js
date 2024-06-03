const columns = [
  {
    data: null,
    sortable: false,
    render: function (data, type, row, meta) {
      return meta.row + meta.settings._iDisplayStart + 1;
    },
  },
  {
    data: "name",
    name: "name",
  },
  {
    data: "route",
    name: "route",
  },
  {
    data: "icon",
    name: "icon",
  },
  {
    data: "has_submenu",
    name: "has_submenu",
  },
  {
    data: "desc",
    name: "desc",
  },
  {
    data: "aksi",
    name: "aksi",
  },
];

const columnDefs = [
  {
    targets: [0, 6],
    orderable: false,
    className: "text-right",
  },
  {
    targets: [4],
    orderable: true,
    className: "text-center",
  },
  {
    targets: [1, 2, 3, 5],
    orderable: true,
  },
];
