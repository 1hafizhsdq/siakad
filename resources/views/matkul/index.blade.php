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
                    Data Mata Kuliah
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="15%">No.</th>
                            <th>Program Studi</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Nilai Minimal</th>
                            <th>Kompetensi</th>
                            <th width="15%">
                                <a href="/matkul/create" class="btn btn-xs btn-success addData" title="Tambah Data">
                                    <i class="bi bi-plus"></i> Add Data
                                </a>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    @includeIf('matkul.modal')
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
                    url: 'matkul-list',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'prodi.nama_prodi'
                    },
                    {
                        data: 'kode'
                    },
                    {
                        data: 'mata_kuliah'
                    },
                    {
                        data: 'sks'
                    },
                    {
                        data: 'min_nilai'
                    },
                    {
                        data: 'kompetensi'
                    },
                    {
                        data: 'aksi',
                        class: 'text-center'
                    },
                ],
                destroy: true,
            });
        }).on('click','.editData',function(){
            $.ajax({
                url: "/matkul/"+$(this).data('id')+"/edit",
                type: 'GET',
                success: function(result) {
                    $('#id').val(result.id);
                    $('#prodi_id').val(result.prodi_id);
                    $('#mata_kuliah').val(result.mata_kuliah);
                    $('#sks').val(result.sks);
                    $('#modal-title').html('Edit Data Mata Kuliah');
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
                        url: "/matkul/"+$(this).data('id'),
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
