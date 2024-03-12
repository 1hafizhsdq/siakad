<table class="table table-striped" id="table-dosen" width="100%">
    <thead>
        <tr>
            <th width="15%">No.</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th width="15%">#</th>
        </tr>
    </thead>
</table>

@push('script-dosen')
    <script>
        $(document).ready(function () {
            $('#table-dosen').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: 'user-list/3',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'no_induk'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'telp'
                    },
                    {
                        data: 'aksi',
                        class: 'text-center'
                    },
                ],
                destroy: true,
            });
        });
    </script>
@endpush