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
    data: "harga",
    name: "barang_belanja.harga",
  },
  {
    data: "jumlah",
    name: "barang_belanja.jumlah",
  },
  {
    data: "total",
  },
  {
    data: "desc",
    name: "barang_belanja.desc",
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
    targets: [2, 3, 7],
    orderable: true,
  },
  {
    targets: [4, 5, 6],
    orderable: false,
    className: "text-right",
  },
];
