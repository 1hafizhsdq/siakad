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
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="admin-tab" data-bs-toggle="tab" href="#admin" role="tab"
                                        aria-controls="admin" aria-selected="true">Admin</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="dosen-tab" data-bs-toggle="tab" href="#dosen" role="tab"
                                        aria-controls="dosen" aria-selected="false">Dosen</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="mahasiswa-tab" data-bs-toggle="tab" href="#mahasiswa" role="tab"
                                        aria-controls="mahasiswa" aria-selected="false">Mahasiswa</a>
                                </li>
                            </ul>
                            <button id="add" class="btn btn-xs btn-success addData mt-2" title="Tambah Data">
                                <i class="bi bi-plus"></i> Add Data
                            </button>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                                    @includeIf('user.admin')
                                </div>
                                <div class="tab-pane fade" id="dosen" role="tabpanel" aria-labelledby="dosen-tab">
                                    @includeIf('user.dosen')
                                </div>
                                <div class="tab-pane fade" id="mahasiswa" role="tabpanel" aria-labelledby="mahasiswa-tab">
                                    @includeIf('user.mahasiswa')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @includeIf('user.modal')
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#add').click(function () {
                $('#modal-title').html('Tambah Data User');
                $('#modal').modal('show');
            });

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
                            $('#table-admin').DataTable().ajax.reload();
                            $('#table-dosen').DataTable().ajax.reload();
                            $('#table-mahasiswa').DataTable().ajax.reload();
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
        }).on('click','.isactive', function() {
            var id = $(this).data('id');
            var status = $(this).data('status');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/user-isactive",
                type: 'GET',
                data: {
                    id:id,
                    status:status,
                },
                success: function (result) {
                    if (result.success) {
                        successMsg(result.success)
                        $('#table-admin').DataTable().ajax.reload();
                        $('#table-dosen').DataTable().ajax.reload();
                        $('#table-mahasiswa').DataTable().ajax.reload();
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
        }).on('click','.resetData', function() {
            var id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/user-reset",
                type: 'GET',
                data: {
                    id:id,
                },
                success: function (result) {
                    if (result.success) {
                        successMsg(result.success)
                        $('#table-admin').DataTable().ajax.reload();
                        $('#table-dosen').DataTable().ajax.reload();
                        $('#table-mahasiswa').DataTable().ajax.reload();
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
        }).on('click','.editData',function(){
            $.ajax({
                url: "/user/"+$(this).data('id')+"/edit",
                type: 'GET',
                success: function(result) {
                    $('#id').val(result.id);
                    $('#role_id').val(result.role_id);
                    $('#nama').val(result.nama);
                    $('#email').val(result.email);
                    $('#telp').val(result.telp);
                    $('#alamat').val(result.alamat);
                    $('#jenis_kelamin').val(result.jenis_kelamin);
                    $('#tempat_lahir').val(result.tempat_lahir);
                    $('#tgl_lahir').val(result.tgl_lahir);
                    $('#modal-title').html('Edit Data User');
                    $('#modal').modal('show');
                }
            });
        });
    </script>
    @stack('script-admin')
    @stack('script-dosen')
    @stack('script-mahasiswa')
@endpush