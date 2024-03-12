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