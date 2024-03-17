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
                    Data Jadwal Kuliah Mahasiswa
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="prodi_id">Tahun Ajaran </label>
                        <div class="form-group">
                            <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-select">
                                @foreach($tahun_ajarans as $ta)
                                    <option value="{{ $ta->id }}" {{ ($ta->is_active == 1) ? 'selected' : '' }}>{{ $ta->nama_tahun_ajaran }} - {{ $ta->semester }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for=""></label>
                        <div class="form-group">
                            <button id="tampil" class="btn btn-xs btn-success" title="Tampilkan Data">
                                <i class="bi bi-eye"></i> Tampilkan Data
                            </button>
                        </div>
                    </div>
                </div>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Matkul</th>
                            <th>Jadwal</th>
                            <th>Ruangan</th>
                            <th>Dosen Pengampu</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
    <script>
        function tableData(tahunajaran){
            $('#table1').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: '/jadwalkuliah-list-mahasiswa/'+tahunajaran,
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'text-center'
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
                        data: 'dosen'
                    },
                ],
                destroy: true,
            });
        }

        $(document).ready(function () {
            $('#tampil').click(function () {
                tahunajaran = $('#tahun_ajaran_id').val();
                if(tahunajaran == ''){
                    errorMsg('Pilih Tahun Ajaran terlebih dahulu!')
                }else{
                    tableData(tahunajaran);
                }
            });
            
        });

    </script>
@endpush
