@extends('layouts.master')

@section('title')
    Daftar Produk
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Produk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <button onclick="addForm('{{ route('produk.store') }}')" class="btn btn-success btn-xs btn-flat"
                            data-bs-toggle="modal" data-bs-target="#modal-form"><i class="fa fa-plus-circle"></i> Tambah</button>
                        <button onclick="deleteSelected('{{ route('produk.delete_selected') }}')" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i> Hapus</button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="" class="form-produk">
                        @csrf
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <th>
                                    <strong><input type="checkbox" name="select_all" id="select_all"></strong>
                                </th>
                                <th width="5%">No</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Diskon</th>
                                <th>Stok</th>
                                <th width="7%"><i class="fa fa-cog"></i></th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @includeIf('produk.form')
@endsection

@push('scripts')
    <script type="text/javascript">
        let table;

        $(document).ready(function() {
            // Inisialisasi DataTable dengan konfigurasi lengkap
            table = $('#myTable').DataTable({
                pageLength: 10,
                processing: true,
                lengthChange: false,
                autoWidth: false,
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print',
                    {
                        extend: 'colvis',
                        text: 'Atur Kolom',
                    }
                ],
                ajax: {
                    url: '{{ route('produk.data') }}',
                },
                columns: [
                    { data: 'select_all', searchable: false, sortable: false },
                    { data: 'DT_RowIndex', searchable: false, sortable: false },
                    { data: 'kode_produk' },
                    { data: 'nama_produk' },
                    { data: 'nama_kategori' },
                    { data: 'merk' },
                    { data: 'harga_beli' },
                    { data: 'harga_jual' },
                    { data: 'diskon' },
                    { data: 'stok' },
                    { data: 'aksi', searchable: false, sortable: false },
                ],
            });

            // Fokus ke input pertama saat modal ditampilkan
            $('#modal-form').on('shown.bs.modal', function() {
                $('#nama_produk').focus();
            });

            $('#modal-form').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                        .done((response) => {
                            $('#modal-form').modal('hide');
                            Swal.fire(
                                'Tersimpan!',
                                response.message,
                                'success'
                            );
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            console.log(errors);
                            alert('Tidak dapat menyimpan data!');
                            return;
                        });
                }
            });

            $('[name=select_all]').on('click', function() {
                $(':checkbox').prop('checked', this.checked);
            });
            // $('#select_all').on('click', function() {
                // $('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
            // });
        });

        // Deklarasikan fungsi di global scope
        // Fungsi untuk membuka modal tambah form
        function addForm(url) {
            $('#modal-form').modal('show'); // Menampilkan modal
            $('#modal-form .modal-title').text('Tambah Produk'); // Set judul modal

            $('#modal-form form')[0].reset(); // Reset form pada modal
            $('#modal-form form').attr('action', url); // Set URL form action dengan URL pada parameter
            $('#modal-form [name=_method]').val('post'); // Isi value dari input [name=_method] dengan 'post'
            $('#modal-form [name=nama_produk]').focus(); // Fokus ke input [name=nama_produk]
        }

        // Fungsi untuk membuka modal edit form
        function editForm(url) {
            $('#modal-form').modal('show'); // Menampilkan modal
            $('#modal-form .modal-title').text('Edit Produk'); // Set judul modal

            $('#modal-form form')[0].reset(); // Reset form pada modal
            $('#modal-form form').attr('action', url); // Set URL form action dengan URL pada parameter
            $('#modal-form [name=_method]').val('put'); // Isi value dari input [name=_method] dengan 'post'
            $('#modal-form [name=nama_produk]').focus(); // Fokus ke input [name=nama_produk]

            $.get(url) // Ambil data dari URL pada parameter
                .done((response) => {
                    $('#modal-form [name=nama_produk]').val(response.nama_produk);
                    $('#modal-form [name=kode_produk]').val(response.kode_produk);
                    $('#modal-form [name=id_kategori]').val(response.id_kategori);
                    $('#modal-form [name=merk]').val(response.merk);
                    $('#modal-form [name=harga_beli]').val(response.harga_beli);
                    $('#modal-form [name=harga_jual]').val(response.harga_jual);
                    $('#modal-form [name=diskon]').val(response.diskon);
                    $('#modal-form [name=stok]').val(response.stok);
                })
                .fail((errors) => {
                    console.log(errors);
                    alert('Tidak dapat menampilkan data!');
                    return;
                });
        }

        // Fungsi untuk menghapus data dengan SweetAlert2
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
                    $.post(url, { // Kirim data ke URL pada parameter
                            _method: 'delete', // Isi value dari input [_method] dengan 'delete'
                            _token: $('[name=csrf-token]').attr(
                                'content') // Isi value dari input [_token] dengan token CSRF
                        })
                        .done((response) => {
                            Swal.fire(
                                'Terhapus!',
                                response.message,
                                'success'
                            );
                            table.ajax.reload(); // Reload data pada DataTable
                        })
                        .fail((errors) => {
                            console.log(errors);
                            Swal.fire(
                                'Gagal!',
                                'Tidak dapat menghapus data.',
                                'error'
                            );
                            return;
                        });
                }
            });
        }

        // Fungsi untuk menghapus data yang dipilih
        function deleteSelected(url) {
            if ($('input:checked').length > 1) {
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
                        $.post(url, $('.form-produk').serialize())
                        .done((response) => {
                            Swal.fire(
                                'Terhapus!',
                                response.message,
                                'success'
                            );
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            console.log(errors);
                            Swal.fire(
                                'Gagal!',
                                'Tidak dapat menghapus data.',
                                'error'
                            );
                            return;
                        });
                    }
                });
            }else{
                // alert('Pilih data yang akan dihapus!');
                Swal.fire(
                    'Informasi!',
                    'Pilih data yang akan dihapus.',
                    'info'
                );
                return;
            }
        }
    </script>
@endpush
