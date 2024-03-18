@extends('layouts.main')

@section('title', $title)

@push('css')
@endpush

@section('content')
<div class="page-heading">
    <h3>{{ $title }}</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data User</h4>
                        </div>
                        <div class="card-body">
                            <form id="form">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $user->id ?? '' }}">
                                <div class="modal-body">
                                    <label for="role_id">Role </label>
                                    <div class="form-group">
                                        <select name="role_id" id="role_id" class="form-select">
                                            <option value="">-- Pilih Role --</option>
                                            @foreach ($role as $rl)
                                                <option value="{{ $rl->id }}" {{ (!empty($user)) ? ($rl->id == $user->role_id) ? 'selected' : '' : '' }}>{{ $rl->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="no_induk">NIP/NIM </label>
                                    <div class="form-group">
                                        <input id="no_induk" name="no_induk" type="text" value="{{ $user->no_induk ?? '' }}" placeholder="NIP/NIM" class="form-control" onkeypress="return isNumber(event)">
                                    </div>
                                    <label for="nama">Nama </label>
                                    <div class="form-group">
                                        <input id="nama" name="nama" type="text" value="{{ $user->nama ?? '' }}" placeholder="Nama" class="form-control">
                                    </div>
                                    <label for="email">Email </label>
                                    <div class="form-group">
                                        <input id="email" name="email" value="{{ $user->email ?? '' }}" type="text" placeholder="Email" class="form-control">
                                    </div>
                                    <label for="telp">Telepon (WA) </label>
                                    <div class="form-group">
                                        <input id="telp" name="telp" type="text" value="{{ $user->telp ?? '' }}" placeholder="Telepon (WA)" class="form-control" onkeypress="return isNumber(event)">
                                    </div>
                                    <label for="alamat">Alamat </label>
                                    <div class="form-group">
                                        <input id="alamat" name="alamat" value="{{ $user->alamat ?? '' }}" type="text" placeholder="Alamat" class="form-control">
                                    </div>
                                    <label for="jenis_kelamin">Jenis Kelamin </label>
                                    <div class="form-group">
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="Laki-laki" {{ (!empty($user)) ? ($user->jenis_kelamin == "Laki-laki") ? 'selected' : '' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ (!empty($user)) ? ($user->jenis_kelamin == "Perempuan") ? 'selected' : '' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <label for="ttl">Tempat, Tanggal Lahir </label>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input id="tempat_lahir" value="{{ $user->tempat_lahir ?? '' }}" name="tempat_lahir" type="text" placeholder="Tempat Lahir" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <input id="tgl_lahir" name="tgl_lahir" value="{{ $user->tgl_lahir ?? '' }}" type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="/user" class="btn btn-light-secondary">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </a>
                                    <button id="save" type="button" class="btn btn-success ms-1">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Submit</span>
                                    </button>
                                    <button class="btn btn-success spinner" id="loading" style="display: none;" type="button" disabled="">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#save').click(function () {
                var form = $('#form'),
                    data = form.serializeArray();
                data.push({ name: '_token', value: '{{ csrf_token() }}' });
                $('.spinner').css('display', 'block');
                $(this).css('display', 'none');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/user",
                    type: 'POST',
                    data: data,
                    success: function (result) {
                        if (result.success) {
                            successMsg(result.success)
                            $('.spinner').css('display', 'none');
                            $('#save').css('display', 'block');
                            $('#modal').modal('hide');
                            $('#form').find('input').val('');
                            window.location.replace('/user');
                        } else {
                            $('.spinner').css('display', 'none');
                            $('#save').css('display', 'block');
                            $.each(result.errors, function (key, value) {
                                errorMsg(value)
                            });
                        }
                    },
                    complete: function () {
                        var newToken = $('meta[name="csrf-token"]').attr('content');
                        $('input[name="_token"]').val(newToken);
                    }
                });
            });
        });
    </script>
@endpush