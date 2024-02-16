@extends('layouts.main')

@section('title', $title)

@push('css')
@endpush

@section('content')
    <div class="page-heading">
        <h3>Profile Statistics</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Simple Datatable
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Role</th>
                                <th>#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script src="{{ asset('jquery') }}/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table1').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                paging:false,
                ajax: {
                    url: 'role-list',
                },
                columns: [
                    {data: 'DT_RowIndex',class: 'text-center'},
                    {data: 'role'},
                    {data: 'aksi',class: 'text-center'},
                ],
                destroy: true,
            });
        })
    </script>
@endpush