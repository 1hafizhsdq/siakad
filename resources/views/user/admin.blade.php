<table class="table table-striped" id="table-admin">
    <thead>
        <tr>
            <th>No.</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Status</th>
            <th>#</th>
        </tr>
    </thead>
</table>

@push('script-admin')
    <script>
        $(document).ready(function () {
            $('#table-admin').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: 'user-list/2',
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
                        data: 'status'
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