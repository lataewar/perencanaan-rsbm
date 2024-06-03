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
    targets: [0, 5],
    orderable: false,
    className: "text-center",
  },
  {
    targets: [1, 2, 3, 4],
    orderable: true,
  },
];
