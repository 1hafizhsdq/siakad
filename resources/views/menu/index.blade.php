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
                    Data Menu
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Menu</th>
                            <th>URL</th>
                            <th>Parent</th>
                            <th>Sequence</th>
                            <th width="15%">
                                <button id="add" class="btn btn-xs btn-primary addData" title="Tambah Data">
                                    <i class="bi bi-plus"></i> Add Data
                                </button>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    @includeIf('menu.modal')
</div>
@endsection

@push('script')
    <script>
        function parent(parent=null) {
            var selected = '';
            $.ajax({
                url: "/menu/1",
                type: 'GET',
                success: function (result) {
                    $('#parent_id').html('');
                    $('#parent_id').append('<option value="">-- Pilih Parent --</option>');
                    $.each(result, function (key, value) {
                        selected = (parent == value.id) ? 'selected' : '';
                        $('#parent_id').append("<option value='" + value.id +"' "+ selected +">" + value.menu +
                            "</option>");
                    });
                    // populateSelectWithChoices(result);
                }
            });
        }

        function populateSelectWithChoices(data) {
            var select = document.getElementById('parent_id');
            var choices = new Choices(select, {
                searchEnabled: false,
                shouldSort: false,
                placeholder: true,
                placeholderValue: 'Pilih salah satu',
                choices: data.map(function (item) {
                    return {
                        value: item.id,
                        label: item.menu
                    };
                }),
                allowHTML: true,
            });
        }
        $(document).ready(function () {
            $('#table1').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: 'menu-list',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'menu'
                    },
                    {
                        data: 'url'
                    },
                    {
                        data: 'parent'
                    },
                    {
                        data: 'sequence'
                    },
                    {
                        data: 'aksi',
                        class: 'text-center'
                    },
                ],
                destroy: true,
            });

            $('#add').click(function () {
                parent();
                $('#modal-title').html('Tambah Data Menu');
                $('#modal').modal('show');
            });

            $('#save').click(function () {
                var form = $('#form'),
                    data = form.serializeArray();
                data.push({
                    name: '_token',
                    value: '{{ csrf_token() }}'
                });
                $('.spinner').css('display', 'block');
                $(this).css('display', 'none');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/menu",
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
        }).on('click', '.editData', function () {
            $.ajax({
                url: "/menu/" + $(this).data('id') + "/edit",
                type: 'GET',
                success: function (result) {
                    $('#id').val(result.id);
                    $('#menu').val(result.menu);
                    $('#url').val(result.url);
                    $('#icon').val(result.icon);
                    $('#sequence').val(result.sequence);
                    parent(result.parent_id);
                    $('#modal-title').html('Edit Data Menu');
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
                        url: "/menu/" + $(this).data('id'),
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
