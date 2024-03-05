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
                <h5 class="card-title">
                    Data Program Studi
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="15%">No.</th>
                            <th>Nama Program Studi</th>
                            <th>Fakultas</th>
                            <th width="15%">
                                <button id="add" class="btn btn-xs btn-success addData" title="Tambah Data">
                                    <i class="bi bi-plus"></i> Add Data
                                </button>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    @includeIf('prodi.modal')
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#table1').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: 'prodi-list',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'nama_prodi'
                    },
                    {
                        data: 'fakultas.nama_fakultas'
                    },
                    {
                        data: 'aksi',
                        class: 'text-center'
                    },
                ],
                destroy: true,
            });

            $('#add').click(function () {
                $('#modal-title').html('Tambah Data Program Studi');
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
                    url: "/prodi",
                    type: 'POST',
                    data: data,
                    success: function (result) {
                        if (result.success) {
                            successMsg(result.success)
                            $('.spinner').css('display', 'none');
                            $('#save').css('display', 'block');
                            $('#modal').modal('hide');
                            $('#form').find('input').val('');
                            $('#table1').DataTable().ajax.reload();
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
        }).on('click','.editData',function(){
            $.ajax({
                url: "/prodi/"+$(this).data('id')+"/edit",
                type: 'GET',
                success: function(result) {
                    $('#id').val(result.id);
                    $('#nama_prodi').val(result.nama_prodi);
                    $('#fakultas_id').val(result.fakultas_id);
                    $('#modal-title').html('Edit Data Program Studi');
                    $('#modal').modal('show');
                }
            });
        }).on('click','.deleteData',function(){
            Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin akan menghapus data ini?',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                confirmButtonColor: '#d3455b',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/prodi/"+$(this).data('id'),
                        type: 'DELETE',
                        data: {
                            "_token":'{{ csrf_token() }}',
                        },
                        success: function(result) {
                            successMsg(result.success)
                            $('#table1').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });

    </script>
@endpush
