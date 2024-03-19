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
                <form id="form">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $matkul->id ?? '' }}">
                    <div class="modal-body">
                        <label for="prodi_id">Program Studi </label>
                        <div class="form-group">
                            <select name="prodi_id" id="prodi_id" class="form-select">
                                <option value="">-- Pilih Program Studi --</option>
                                @foreach ($prodis as $pr)
                                    <option value="{{ $pr->id }}" {{ (!empty($matkul)) ? ($pr->id == $matkul->prodi_id) ? 'selected' : '' : '' }}>{{ $pr->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="kode">Kode Mata Kuliah </label>
                        <div class="form-group">
                            <input id="kode" name="kode" type="text" placeholder="Kode Mata Kuliah" value="{{ $matkul->kode ?? '' }}" class="form-control">
                        </div>
                        <label for="mata_kuliah">Mata Kuliah </label>
                        <div class="form-group">
                            <input id="mata_kuliah" name="mata_kuliah" type="text" placeholder="Mata Kuliah" value="{{ $matkul->mata_kuliah ?? '' }}" class="form-control">
                        </div>
                        <label for="sks">SKS </label>
                        <div class="form-group">
                            <input id="sks" name="sks" type="text" placeholder="Mata Kuliah" value="{{ $matkul->sks ?? '' }}" class="form-control" onkeypress="return isNumber(event)">
                        </div>
                        <label for="min_nilai">Nilai Minimal </label>
                        <div class="form-group">
                            <input id="min_nilai" name="min_nilai" type="text" placeholder="Cth : 2.25" value="{{ $matkul->min_nilai ?? '' }}" class="form-control" onkeypress="return isNumber(event)">
                        </div>
                        <label for="kompetensi">Kompetensi </label>
                        <div class="form-group">
                            <input id="kompetensi" name="kompetensi" type="text" value="{{ $matkul->kompetensi ?? '' }}" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/matkul" class="btn btn-light-secondary">
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
                data.push({ name: '_token', value: '{{ csrf_token() }}' });
                $('.spinner').css('display', 'block');
                $(this).css('display', 'none');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/matkul",
                    type: 'POST',
                    data: data,
                    success: function (result) {
                        if (result.success) {
                            successMsg(result.success)
                            $('.spinner').css('display', 'none');
                            $('#save').css('display', 'block');
                            $('#modal').modal('hide');
                            $('#form').find('input').val('');
                            window.location.replace('/matkul');
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
