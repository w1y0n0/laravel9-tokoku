@extends('layouts.master')

@section('title')
    Daftar Pembelian
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Pembelian</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <button onclick="addSupplier()" class="btn btn-success btn-xs btn-flat" data-bs-toggle="modal"
                        data-bs-target="#modal-form"><i class="fa fa-plus-circle"></i>
                        Transaksi Baru</button>
                    @empty(! session('id_pembelian'))
                        <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info btn-xs btn-flat"><i
                                class="fa fa-pencil"></i> Transaksi Aktif</a>
                    @endempty
                </div>
                <div class="box-body table-responsive">
                    <table id="table-pembelian" class="table table-striped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Total Item</th>
                            <th>Total Harga</th>
                            <th>Diskon</th>
                            <th>Total Bayar</th>
                            <th width="10%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf('pembelian.supplier')
    @includeIf('pembelian.detail')
@endsection

@push('scripts')
    <script type="text/javascript">
        let tbl_beli, tbl_supplier, tbl_detail;

        $(document).ready(function() {
            tbl_beli = $('#table-pembelian').DataTable({
                pageLength: 10,
                processing: true,
                lengthChange: false,
                autoWidth: false,
                responsive: true,
                serverSide: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print',
                    {
                        extend: 'colvis',
                        text: 'Atur Kolom',
                    }
                ],
                ajax: {
                    url: '{{ route('pembelian.data') }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'tanggal'},
                    {data: 'supplier'},
                    {data: 'total_item'},
                    {data: 'total_harga'},
                    {data: 'diskon'},
                    {data: 'bayar'},
                    {data: 'aksi', searchable: false, sortable: false},
                ],
            });

            tbl_supplier = $('#table-supplier').DataTable({
                processing: true,
                responsive: true,
                autoWidth: false,
                bSort: false,
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'nama'},
                    {data: 'telepon'},
                    {data: 'alamat'},
                    {data: 'pilih'},
                ]
            });

            tbl_detail = $('#table-detail').DataTable({
                processing: true,
                responsive: true,
                autoWidth: false,
                bSort: false,
                dom: 'rt',
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'kode_produk'},
                    {data: 'nama_produk'},
                    {data: 'harga_beli'},
                    {data: 'jumlah'},
                    {data: 'subtotal'},
                ]
            });
        });

        function addSupplier() {
            $('#modal-supplier').modal('show');
        }

        function showDetail(url) {
            $('#modal-detail').modal('show');
            tbl_detail.ajax.url(url);
            tbl_detail.ajax.reload();
        }

        // Fungsi untuk menghapus data
        function deleteData(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(url, {
                            _method: 'delete',
                            _token: $('[name=csrf-token]').attr('content')
                        })
                        .done((response) => {
                            Swal.fire(
                                'Terhapus!',
                                response.message,
                                'success'
                            );
                            tbl_beli.ajax.reload();
                        })
                        .fail((errors) => {
                            console.log(errors);
                            Swal.fire(
                                'Gagal!',
                                'Tidak dapat menghapus data.',
                                'error'
                            );
                        });
                }
            });
        }
    </script>
@endpush
