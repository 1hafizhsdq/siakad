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
                    Daftar Pertemuan
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label for="tahun_ajaran_id">Tahun Ajaran </label>
                        <div class="form-group">
                            <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-select">
                                <option value="">-- Pilih Tahun Ajaran --</option>
                                @foreach($tahunajarans as $th)
                                    <option value="{{ $th->id }}" {{ ($th->is_active == 1) ? 'selected' : '' }}>{{ $th->nama_tahun_ajaran }} - {{ $th->semester }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
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
                    <div class="col-md-3">
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
                            <th>Tahun Ajaran</th>
                            <th>Mata Kuliah</th>
                            <th>Jenis Pertemuan</th>
                            <th>Pertemuan Ke-</th>
                            <th>Waktu</th>
                            <th>
                                <a href="/pertemuan/create" class="btn btn-xs btn-success" title="Tambah Data">
                                    <i class="bi bi-plus"></i> Add Data
                                </a>
                            </th>
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
        function tableData(user,tahunajaran,prodi){
            $('#table1').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                paging: true,
                ajax: {
                    url: '/pertemuan-list/'+user+'/'+tahunajaran+'/'+prodi,
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'tahun_ajaran'
                    },
                    {
                        data: 'matkul.mata_kuliah'
                    },
                    {
                        data: 'jenispertemuan'
                    },
                    {
                        data: 'pertemuan_ke'
                    },
                    {
                        data: 'waktu'
                    },
                    {
                        data: 'aksi',
                        class: 'text-center'
                    },
                ],
                destroy: true,
            });
        }

        $(document).ready(function () {
            $('#tampil').click(function () {
                user = "{{ Auth::user()->id }}";
                tahunajaran = $('#tahun_ajaran_id').val();
                prodi = $('#prodi_id').val();
                if(prodi == ''){
                    errorMsg('Pilih Program Studi dan Tahun Ajaran terlebih dahulu!')
                }else{
                    tableData(user,tahunajaran,prodi);
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
                        url: "/pertemuan/"+$(this).data('id'),
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
