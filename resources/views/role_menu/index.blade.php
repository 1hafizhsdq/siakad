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
                    Data Role Menu
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Menu</th>
                            <th width="10%">User</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    @includeIf('role_menu.modal')
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
                    url: 'role-menu-list',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'menu'
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

                    $('input[type="checkbox"]').each(function () {
                        var name = $(this).attr('name');
                        if (!data.some(item => item.name === name)) {
                            data.push({ name: name, value: 0 }); // Menambahkan nilai 0 untuk checkbox yang tidak dicentang
                        }
                    });

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
                    url: "/role-menu-store",
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
        }).on('click', '.editData',function() {
            var menuid = $(this).data('id');
            var selected = '';
            $.ajax({
                url: "/role-menu-status/"+menuid,
                type: 'GET',
                success: function(result) {
                    console.log(result);
                    $('#rolemenu').html('');
                    var rolemenu = '';
                    $.each(result, function (key, val) {
                        $.each(val.rolemenu, function (k, v) {
                            if(v.menu_id == menuid){
                                selected = 'selected';
                            }else{
                                selected = '';
                            }
                            console.log(selected);
                        });

                        rolemenu += `
                            <div class="form-check form-switch" style="margin: 0.7rem">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="role[`+val.id+`]" `+ selected +`>
                                <label class="form-check-label" for="flexSwitchCheckDefault">`+ val.role +`</label>
                            </div>
                        `;
                    });
                    $('#rolemenu').html(rolemenu);
                    $('#menu_id').val(menuid);
                    $('#modal-title').html('Konfigurasi Menu Role');
                    $('#modal').modal('show');
                }
            });
        });
    </script>
@endpush
