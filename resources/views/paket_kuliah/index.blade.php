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
                    Data Paket Kuliah
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
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
                            <th>Nama Paket</th>
                            <th>Semester</th>
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
    @includeIf('paket_kuliah.modal')
</div>
@endsection

@push('script')
    <script>
        function tableData(prodi){
            $('#table1').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: '/paketkuliah-list/'+prodi,
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'nama_paket'
                    },
                    {
                        data: 'semester'
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
                prodi = $('#prodi_id').val();
                if(prodi == ''){
                    errorMsg('Pilih Program Studi terlebih dahulu!')
                }else{
                    tableData(prodi);
                }
            });
            
            $('#add').click(function () {
                prodi = $('#prodi_id').val();
                if(prodi == ''){
                    errorMsg('Pilih Program Studi terlebih dahulu!')
                }else{
                    $('#modal-title').html('Tambah Data Paket Kuliah');
                    $('#modal').modal('show');
                }
            });

            $('#save').click(function () {
                var form = $('#form'),
                    data = form.serializeArray();
                data.push(
                    {
                        name: 'prodi_id',
                        value: $('#prodi_id').val()
                    },
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
                    url: "/paketkuliah",
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
        }).on('click','.editData',function(){
            $.ajax({
                url: "/paketkuliah/"+$(this).data('id')+"/edit",
                type: 'GET',
                success: function(result) {
                    $('#id').val(result.id);
                    $('#prodi_id').val(result.prodi_id);
                    $('#nama_paket').val(result.nama_paket);
                    $('#semester').val(result.semester);
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
                        url: "/paketkuliah/" + $(this).data('id'),
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
