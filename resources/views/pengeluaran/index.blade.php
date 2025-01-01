@extends('layouts.master')

@section('title')
    Daftar Pengeluaran
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Pengeluaran</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <button onclick="addForm('{{ route('pengeluaran.store') }}')" class="btn btn-success btn-xs btn-flat"
                        data-bs-toggle="modal" data-bs-target="#modal-form"><i class="fa fa-plus-circle"></i>
                        Tambah</button>
                </div>
                <div class="box-body table-responsive">
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
                            <th width="10%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf('pengeluaran.form')
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
                    url: '{{ route('pengeluaran.data') }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'tanggal'},
                    {data: 'deskripsi'},
                    {data: 'nominal'},
                    {data: 'aksi', searchable: false, sortable: false}
                ],
            });

            // Fokus ke input saat modal ditampilkan
            $('#modal-form').on('shown.bs.modal', function() {
                $('#deskripsi').focus();
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
        });

        // Deklarasikan fungsi di global scope
        // Fungsi untuk membuka modal tambah form
        function addForm(url) {
            $('#modal-form').modal('show'); // Menampilkan modal
            $('#modal-form .modal-title').text('Tambah Pengeluaran'); // Set judul modal

            $('#modal-form form')[0].reset(); // Reset form pada modal
            $('#modal-form form').attr('action', url); // Set URL form action dengan URL pada parameter
            $('#modal-form [name=_method]').val('post'); // Isi value dari input [name=_method] dengan 'post'
            $('#modal-form [name=deskripsi]').focus(); // Fokus ke input [name=deskripsi]
        }

        // Fungsi untuk membuka modal edit form
        function editForm(url) {
            $('#modal-form').modal('show'); // Menampilkan modal
            $('#modal-form .modal-title').text('Edit Pengeluaran'); // Set judul modal

            $('#modal-form form')[0].reset(); // Reset form pada modal
            $('#modal-form form').attr('action', url); // Set URL form action dengan URL pada parameter
            $('#modal-form [name=_method]').val('put'); // Isi value dari input [name=_method] dengan 'post'
            $('#modal-form [name=deskripsi]').focus(); // Fokus ke input [name=deskripsi]

            $.get(url) // Ambil data dari URL pada parameter
                .done((response) => {
                    $('#modal-form [name=deskripsi]').val(response.deskripsi);
                    $('#modal-form [name=nominal]').val(response.nominal);
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
                        });
                }
            });
        }
    </script>
@endpush
