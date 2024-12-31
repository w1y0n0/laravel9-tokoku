@extends('layouts.master')

@section('title')
    Edit Profil
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Edit Profil</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <form action="{{ route('user.update_profil') }}" method="post" class="form-profil" data-toggle="validator"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="alert alert-success alert-dismissible" id="toast-success" role="alert" aria-live="assertive"
                            aria-atomic="true"
                             style="position: fixed; bottom: 20px; right: 0; transform: translateX(-10%) translateY(-10%); z-index: 1055; display: none; max-width: 100%;">
                            <div class="toast-header">
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                            </div>
                            <div class="toast-body">
                                Perubahan berhasil disimpan
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-lg-2 control-label">Nama</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" class="form-control" id="name" required autofocus
                                    value="{{ $profil->name }}">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="foto" class="col-lg-2 control-label">Profil</label>
                            <div class="col-lg-4">
                                <input type="file" name="foto" class="form-control" id="foto"
                                    onchange="preview('.tampil-foto', this.files[0])">
                                <span class="help-block with-errors"></span>
                                <br>
                                <div class="tampil-foto">
                                    <img src="{{ url($profil->foto ?? '/') }}" width="200">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old_password" class="col-lg-2 control-label">Password Lama</label>
                            <div class="col-lg-6">
                                <input type="password" name="old_password" id="old_password" class="form-control"
                                    minlength="6">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-6">
                                <input type="password" name="password" id="password" class="form-control" minlength="6">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-lg-2 control-label">Konfirmasi
                                Password</label>
                            <div class="col-lg-6">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" data-match="#password">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer text-right">
                        <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#old_password').on('keyup', function() {
                if ($(this).val() != "") $('#password, #password_confirmation').attr('required', true);
                else $('#password, #password_confirmation').attr('required', false);
            });
            $('.form-profil').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                            url: $('.form-profil').attr('action'),
                            type: $('.form-profil').attr('method'),
                            data: new FormData($('.form-profil')[0]),
                            async: false,
                            processData: false,
                            contentType: false
                        })
                        .done(response => {
                            $('[name=name]').val(response.name);
                            $('.tampil-foto').html(
                                `<img src="{{ url('/') }}${response.foto}" width="200">`);
                            $('.img-profil').attr('src', `{{ url('/') }}/${response.foto}`);

                            // Tampilkan toast
                            const toastSuccess = $('#toast-success');
                            toastSuccess.fadeIn();
                            setTimeout(() => {
                                toastSuccess.fadeOut();
                            }, 3000);
                            // reload halaman
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        })
                        .fail(errors => {
                            if (errors.status == 422) {
                                alert(errors.responseJSON);
                            } else {
                                alert('Tidak dapat menyimpan data');
                            }
                            return;
                        });
                }
            });
        });
    </script>
@endpush
