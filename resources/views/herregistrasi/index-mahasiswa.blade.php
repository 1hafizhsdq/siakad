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
                    Data Herregistrasi Mahasiswa
                </h5>
            </div>
            <div class="card-body">
                <div class="row my-2">
                    <div class="col-md-4 form-group" style="display: none;">
                        <label for="filter_tahun_ajaran_id">Tahun Ajaran</label>
                        <select class="form-select" id="filter_tahun_ajaran_id" name="filter_tahun_ajaran_id">
                            @foreach($tahun_ajarans as $th)
                                <option value="{{ $th->id }}"
                                    {{ ($th->is_active == 1) ? 'selected' : '' }}>
                                    {{ $th->nama_tahun_ajaran }} {{ $th->semester }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="filter_prodi_id">Program Studi</label>
                        <select class="form-select" id="filter_prodi_id" name="filter_prodi_id" disabled>
                            <option value="">-- Semua Program Studi --</option>
                            @foreach($prodi as $p)
                                <option value="{{ $p->id }}" {{ ($last_pendaftaran->prodi_id == $p->id) ? 'selected' : '' }}>{{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <a href="/herreg/create" class="btn btn-xs btn-success addData" title="Tambah Data">
                    <i class="bi bi-plus"></i> Herregistrasi
                </a>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="15%">No.</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Bukti</th>
                            <th>status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    @includeIf('herregistrasi.modal-mahasiswa')
</div>
@endsection

@push('script')
    <script>
        function tableData(tahunajaran,prodi,user){
            $('#table1').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: '/herreg-list/'+tahunajaran+'/'+prodi+'/'+user,
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'nim'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'bukti'
                    },
                    {
                        data: 'status'
                    },
                ],
                destroy: true,
            });
        }

        function filter(){
            var filtertahunajaran = ($('#filter_tahun_ajaran_id').val() == '') ? '' : $('#filter_tahun_ajaran_id').val();
            var filterprodi = ($('#filter_prodi_id').val() == '') ? '' : $('#filter_prodi_id').val();
            var user = '{{ Auth::user()->id }}';

            tableData(filtertahunajaran,filterprodi,user);
        }
        $(document).ready(function () {
            filter();

            $('#add').click(function () {
                $('#modal-title').html('Herregristrasi');
                $('#modal').modal('show');
            });
        }).on('click','#save', function() {
            var form = $('#form')[0],
                data = new FormData(form);

            $('.spinner').css('display', 'block');
            $(this).css('display', 'none');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/pendaftaran-herregistrasi",
                type: 'POST',
                processData: false,
                contentType: false,
                data: data,
                success: function (result) {
                    if (result.success) {
                        successMsg(result.success)
                        $('.spinner').css('display', 'none');
                        $('#save').css('display', 'block');
                        $('#form').find('input').val('');
                        tampil();
                    } else {
                        $('.spinner').css('display', 'none');
                        $('#save').css('display', 'block');
                        $.each(result.errors, function (key, value) {
                            errorMsg(value)
                        });
                    }
                }
            });
        });

    </script>
@endpush
