@extends('layouts.master')

@section('title')
    Daftar Kategori
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <button onclick="addForm('{{ route('kategori.store') }}')" class="btn btn-success btn-xs btn-flat"><i
                            class="fa fa-plus-circle"></i>
                        Tambah</button>
                </div>
                <div class="box-body table-responsive">
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                            </tr>
                            {{-- <th width="5%">No</th>
                            <th>Kategori</th>
                            <th width="15%"><i class="fa fa-cog"></i></th> --}}
                        </thead>
                        <tbody>
                            <tr>
                                <td>Trident</td>
                                <td>Internet
                                    Explorer 4.0
                                </td>
                                <td>Win 95+</td>
                                <td> 4</td>
                                <td>X</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf('kategori.form')
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Inisialisasi DataTable dengan konfigurasi lengkap
            let table = $('#myTable').DataTable({
                processing: true,
                lengthChange: false,
                autoWidth: false,
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print',
                    {
                        extend: 'colvis',
                        text: 'Column visibility'
                    }
                ],
                // ajax: {
                //     url: '{{ route('kategori.data') }}',
                //     type: 'GET',
                // },
            });

            $('#modal-form').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                            url: $('#modal-form form').attr('action'),
                            type: 'post',
                            data: $('#modal-form form').serialize()
                        })
                        .done((response) => {
                            $('#modal-form').modal('hide');
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

        // Deklarasikan fungsi addForm di global scope
        // Fungsi untuk membuka modal tambah kategori
        function addForm(url) {
            $('#modal-form').modal('show'); // Menampilkan modal
            $('#modal-form .modal-title').text('Tambah Kategori'); // Set judul modal

            $('#modal-form form')[0].reset(); // Reset form pada modal
            $('#modal-form form').attr('action', url); // Set URL form action dengan URL pada parameter
            $('#modal-form [name=_method]').val('post'); // Isi value dari input [name=_method] dengan 'post'
            $('#modal-form [name=nama_kategori]').focus(); // Fokus ke input [name=nama_kategori]
        }
    </script>
@endpush
