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
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="avatar avatar-2xl">
                                    <img src="{{ asset('dist') }}/assets/compiled/jpg/1.jpg" alt="Avatar">
                                </div>
    
                                <h3 class="mt-3">{{ $user->nama }}</h3>
                                <p class="text-small">{{ $user->role->role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form id="form">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $user->id ?? '' }}">
                                <input type="hidden" name="role_id" id="role_id" value="{{ $user->role_id ?? '' }}">
                                <label for="no_induk">NIP/NIM/NIY </label>
                                <div class="form-group">
                                    <input id="no_induk" name="no_induk" type="text" value="{{ $user->no_induk ?? '' }}" placeholder="NIP/NIM/NIY" class="form-control" onkeypress="return isNumber(event)">
                                </div>
                                @if ($user->role_id == 3)
                                <label for="nidn" class="nidn">NIDN </label>
                                <div class="form-group">
                                    <input id="nidn" name="nidn" type="text" value="{{ $user->nidn ?? '' }}" placeholder="NIDN" class="form-control nidn" onkeypress="return isNumber(event)">
                                </div>
                                @endif
                                <label for="nik">NIK </label>
                                <div class="form-group">
                                    <input id="nik" name="nik" type="text" value="{{ $user->nik ?? '' }}" placeholder="NIK" class="form-control" onkeypress="return isNumber(event)">
                                </div>
                                <label for="nama">Nama </label>
                                <div class="form-group">
                                    <input id="nama" name="nama" type="text" value="{{ $user->nama ?? '' }}" placeholder="Nama" class="form-control">
                                </div>
                                <label for="gelar">Gelar </label>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input id="gelar_depan" value="{{ $user->gelar_depan ?? '' }}" name="gelar_depan" type="text" placeholder="Gelar Depan" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <input id="gelar_belakang" value="{{ $user->gelar_belakang ?? '' }}" name="gelar_belakang" type="text" placeholder="Gelar Belakang" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <label for="email">Email </label>
                                <div class="form-group">
                                    <input id="email" name="email" value="{{ $user->email ?? '' }}" type="text" placeholder="Email" class="form-control">
                                </div>
                                <label for="telp" class="telp">Telepon (WA) </label>
                                <div class="form-group">
                                    <input id="telp" name="telp" type="text" value="{{ $user->telp ?? '' }}" placeholder="Telepon (WA)" class="form-control telp" onkeypress="return isNumber(event)">
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
                                <label for="agama">Agama </label>
                                <div class="form-group">
                                    <select name="agama" id="agama" class="form-select">
                                        <option value="">-- Pilih Agama --</option>
                                        @foreach ($agamas as $a)
                                        <option value="{{ $a->id }}" {{ ($user->agama_id == $a->id) ? 'selected' : '' }}>{{ $a->agama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <a href="{{ url()->previous() }}" class="btn btn-light-secondary">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </a>
                                <button id="save" type="button" class="btn btn-success ms-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Simpan Perubahan</span>
                                </button>
                                <button class="btn btn-success spinner" id="loading" style="display: none;" type="button" disabled="">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Ubah Password</h5>
                </div>
                <div class="card-body">
                    <form id="form-password">
                        @csrf
                        <input type="hidden" name="id_password" id="id_password" value="{{ $user->id }}">
                        <div class="form-group my-2">
                            <label for="password" class="form-label">Password Lama</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password lama">
                        </div>
                        <div class="form-group my-2">
                            <label for="newpassword" class="form-label">Password Baru</label>
                            <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="Masukkan password baru" value="">
                        </div>
                        <div class="form-group my-2">
                            <label for="renewpassword" class="form-label">Ulangi Password Baru</label>
                            <input type="password" name="renewpassword" id="renewpassword" class="form-control" placeholder="Masukkan password baru kembali" value="">
                        </div>

                        <div class="form-group my-2 d-flex justify-content-end">
                            <button type="button" id="save-password" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
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
                            setInterval(function () {
                                location.reload();
                            }, 2000);
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

            $('#save-password').click(function () {
                var form = $('#form-password'),
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
                    url: "/change-password",
                    type: 'POST',
                    data: data,
                    success: function (result) {
                        if (result.success) {
                            successMsg(result.success)
                            $('.spinner').css('display', 'none');
                            $('#save-password').css('display', 'block');
                            location.reload();
                        } else {
                            $('.spinner').css('display', 'none');
                            $('#save-password').css('display', 'block');
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