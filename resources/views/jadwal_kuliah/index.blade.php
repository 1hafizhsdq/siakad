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
                    Data Jadwal Kuliah
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="tahun_ajaran_id">Tahun Ajaran </label>
                        <div class="form-group">
                            <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-select">
                                @foreach($tahun_ajarans as $th)
                                    <option value="{{ $th->id }}"
                                        {{ ($th->is_active == 1) ? 'selected' : '' }}>
                                        {{ $th->nama_tahun_ajaran }} - {{ $th->semester }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="prodi_id">Program Studi </label>
                        <div class="form-group">
                            <select name="prodi_id" id="prodi_id" class="form-select">
                                <option value="">-- Pilih Program Studi --</option>
                                @foreach($prodis as $pr)
                                    <option value="{{ $pr->id }}">{{ $pr->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button id="tampil" class="btn btn-xs btn-success" title="Tampilkan Data">
                    <i class="bi bi-eye"></i> Tampilkan Data
                </button>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Dosen Pengampu</th>
                            <th>Matkul</th>
                            <th>Jadwal</th>
                            <th>Ruangan</th>
                            <th>
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
    @includeIf('jadwal_kuliah.modal')
</div>
@endsection

@push('script')
    <script>
        function tableData(tahunAjaran,prodi){
            $('#table1').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: '/jadwalkuliah-list/'+tahunAjaran+'/'+prodi,
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'dosen'
                    },
                    {
                        data: 'matkul'
                    },
                    {
                        data: 'jadwal'
                    },
                    {
                        data: 'ruangan'
                    },
                    {
                        data: 'aksi',
                        class: 'text-center'
                    },
                ],
                destroy: true,
            });
        }

        function matkul(prodi){
            matkul = '';
            $.ajax({
                url: "/jadwalkuliah-matkul/" + prodi,
                type: 'GET',
                success: function (result) {
                    $('#matkul_id').html();
                    $.each(result, function (k, v) {
                        matkul += '<option value="'+v.id+'">'+v.mata_kuliah+' ('+v.sks+' SKS)</option>';
                    });
                    $('#matkul_id').html(matkul);
                }
            });
        }

        $(document).ready(function () {
            $('#tampil').click(function () {
                tahunAjaran = $('#tahun_ajaran_id').val();
                prodi = $('#prodi_id').val();
                if(prodi == ''){
                    errorMsg('Pilih Program Studi terlebih dahulu!')
                }else{
                    tableData(tahunAjaran,prodi);
                }
            });
            
            $('#add').click(function () {
                tahunAjaran = $('#tahun_ajaran_id').val();
                prodi = $('#prodi_id').val();
                if(prodi == ''){
                    errorMsg('Pilih Program Studi terlebih dahulu!')
                }else{
                    matkul = '<option value="">-- Pilih Mata Kuliah --</option>';
                    $.ajax({
                        url: "/jadwalkuliah-matkul/" + prodi,
                        type: 'GET',
                        success: function (result) {
                            $('#matkul_id').html();
                            $.each(result, function (k, v) {
                                matkul += '<option value="'+v.id+'">'+v.mata_kuliah+' ('+v.sks+' SKS)</option>';
                            });
                            $('#matkul_id').html(matkul);
                        }
                    });
                    $('#modal-title').html('Tambah Data Jadwal Perkuliahan');
                    $('#modal').modal('show');
                }
            });

            $('#save').click(function () {
                var tahunAjaran = $('#tahun_ajaran_id').val();
                var prodi = $('#prodi_id').val();

                var form = $('#form'),
                    data = form.serializeArray();
                data.push(
                    {
                        name: '_token',
                        value: '{{ csrf_token() }}'
                    },
                    {
                        name: 'prodi_id',
                        value: prodi
                    },
                    {
                        name: 'tahun_ajaran_id',
                        value: tahunAjaran
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
                    url: "/jadwalkuliah",
                    type: 'POST',
                    data: data,
                    success: function (result) {
                        if (result.success) {
                            successMsg(result.success)
                            $('.spinner').css('display', 'none');
                            $('#save').css('display', 'block');
                            $('#modal').modal('hide');
                            $('#form').find('input').val('');
                            $('#tampil').trigger('click');
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
        }).on('click', '.editData', function () {
            $.ajax({
                url: "/jadwalkuliah/" + $(this).data('id') + "/edit",
                type: 'GET',
                success: function (result) {
                    $('#id').val(result.id);
                    $('#jam_ke').val(result.jam_ke);
                    $('#mulai').val(result.mulai);
                    $('#selesai').val(result.selesai);
                    $('#modal-title').html('Edit Data Jadwal Perkuliahan');
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
                        url: "/jadwalkuliah/" + $(this).data('id'),
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
