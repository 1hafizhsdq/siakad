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
                    {{ $paket->nama_paket }}
                </h5>
            </div>
            <div class="card-body">
                <form id="form">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $paket->id }}">
                    <ul class="list-group">
                    @foreach ($listPaket as $lp)
                        <li class="list-group-item">
                            <input id="checkbox-1" class="form-check-input me-1" type="checkbox" name="jadwal[]" value="{{ $lp->id }}" aria-label="...">
                            <label for="checkbox-1">{{ $lp->hari }} ({{ $lp->jam_perkuliahan->mulai }} - {{ $lp->jam_perkuliahan->selesai }}) - {{ $lp->matkul->mata_kuliah }}</label>
                        </li>
                    @endforeach
                    </ul>
                    <div class="modal-footer mt-3">
                        <a href="/paketkuliah/{{ $paket->id }}" class="btn btn-light-secondary">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </a>
                        <button id="save" type="button" class="btn btn-success ms-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Submit</span>
                        </button>
                        <button class="btn btn-success spinner" id="loading" style="display: none;" type="button" disabled="">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#save').click(function () {
                var form = $('#form'),
                    data = form.serializeArray();
                data.push(
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
                    url: "/paketkuliah-detail",
                    type: 'POST',
                    data: data,
                    success: function (result) {
                        if (result.success) {
                            successMsg(result.success)
                            $('.spinner').css('display', 'none');
                            $('#save').css('display', 'block');
                            $('#form').find('input').val('');
                            window.location.replace("/paketkuliah/{{ $paket->id }}")
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
        });

    </script>
@endpush
