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
                    {{ $paket->nama_paket }}
                </h5>
            </div>
            <div class="card-body">
                <a href="/paketkuliah-detail-form/{{ $paket->id }}/{{ $paket->prodi_id }}" class="btn btn-xs btn-success" title="Tambah Data">
                    <i class="bi bi-plus"></i> Tambah Data
                </a>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Waktu</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    @includeIf('paket_kuliah.modal-detail')
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
                    url: '/paketkuliah-list-detail/{{ $paket->id }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'waktu'
                    },
                    {
                        data: 'matkul'
                    },
                    {
                        data: 'dosen'
                    },
                    {
                        data: 'aksi',
                        class: 'text-center'
                    },
                ],
                destroy: true,
            });

            $('#save').click(function () {
                var form = $('#form'),
                    data = form.serializeArray();
                data.push(
                    {
                        name: '_token',
                        value: '{{ csrf_token() }}'
                    },
                );
                $('.spinner').css('display', 'block');
                $(this).css('display', 'none');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/paketkuliah-detail",
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
        }).on('click','#add', function() {
            $.ajax({
                url: "/paketkuliah-matkul/{{ $paket->prodi_id }}",
                type: 'GET',
                success: function(result) {
                    var matkul = '<ul class="list-group">';
                    $.each(result, function (key, val) {
                        matkul += `
                            <li class="list-group-item">
                                <input id="checkbox-1" class="form-check-input me-1" type="checkbox" name="jadwal[]" value="`+val.id+`" aria-label="...">
                                <label for="checkbox-1">`+val.hari+` (`+val.jam_perkuliahan.mulai+` - `+val.jam_perkuliahan.selesai+`) - `+val.matkul.mata_kuliah+`</label>
                            </li>
                        `;
                    });
                    matkul += '</ul>';
                    $('.modal-body').html(matkul);
                    $('#id').val('{{ $paket->id }}');
                    $('#modal-title').html('Edit Data Paket Kuliah');
                    $('#modal').modal('show');
                }
            });
        }).on('click', '.deleteData', function () {
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
                        url: "/paketkuliah-detail/" + $(this).data('id'),
                        type: 'DELETE',
                        data: {
                            "_token": '{{ csrf_token() }}',
                        },
                        success: function (result) {
                            successMsg(result.success)
                            $('#table1').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });

    </script>
@endpush
