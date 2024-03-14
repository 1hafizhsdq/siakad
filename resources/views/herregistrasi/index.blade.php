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
                    <div class="col-md-4 form-group">
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
                        <select class="form-select" id="filter_prodi_id" name="filter_prodi_id">
                            <option value="">-- Semua Program Studi --</option>
                            @foreach($prodi as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="15%">No.</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    @includeIf('herregistrasi.modal')
</div>
@endsection

@push('script')
    <script>
        function tableData(tahunajaran,prodi){
            $('#table1').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: '/herreg-list/'+tahunajaran+'/'+prodi,
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
                        data: 'prodi'
                    },
                    {
                        data: 'bukti'
                    },
                    {
                        data: 'aksi',
                        class: 'text-center'
                    },
                ],
                destroy: true,
            });
        }

        function filter(){
            var filtertahunajaran = ($('#filter_tahun_ajaran_id').val() == '') ? '' : $('#filter_tahun_ajaran_id').val();
            var filterprodi = ($('#filter_prodi_id').val() == '') ? '' : $('#filter_prodi_id').val();

            tableData(filtertahunajaran,filterprodi);
        }
        $(document).ready(function () {
            filter();
        }).on('change','#filter_tahun_ajaran_id', function() {
            filter();
        }).on('change','#filter_prodi_id', function() {
            filter();
        }).on('click','.acceptData', function() {
            var id = $(this).data('id');
            var nim = $(this).data('nim');
            var userid = $(this).data('userid');

            $('#id').val(id);
            $('#nim').val(nim);
            $('#userid').val(userid);
            $('#modal-title').html('Konfirmasi Herregistrasi');
            $('#modal').modal('show');
        }).on('click','#save', function() {
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
                url: "/herreg",
                type: 'POST',
                data: data,
                success: function (result) {
                    if (result.success) {
                        successMsg(result.success)
                        $('.spinner').css('display', 'none');
                        $('#save').css('display', 'block');
                        $('#modal').modal('hide');
                        $('#form').find('input').val('');
                        filter();
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

    </script>
@endpush
