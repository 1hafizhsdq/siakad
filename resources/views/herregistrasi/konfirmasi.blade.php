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
                    Data Herregistrasi Mahasiswa
                </h5>
            </div>
            <div class="card-body">
                <form id="form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" id="id" value="{{ $pendaftaran->id }}">
                            <input type="hidden" name="userid" id="userid" value="{{ $pendaftaran->user_id }}">
                            <input type="hidden" name="prodi_id" id="prodi_id" value="{{ $pendaftaran->prodi_id }}">
                            <input type="hidden" name="tahun_ajaran_id" id="tahun_ajaran_id" value="{{ $pendaftaran->tahun_ajaran_id }}">
                            <label for="nim">NIM </label>
                            <div class="form-group">
                                <input id="nim" name="nim" type="text" class="form-control" value="{{ $pendaftaran->user->no_induk }}">
                            </div>
                            <label for="semester">Semester </label>
                            <div class="form-group">
                                <input id="semester" name="semester" type="text" class="form-control" value="{{ $pendaftaran->semester }}" readonly>
                            </div>
                            <label for="dosen_id">Dosen Wali </label>
                            <div class="form-group">
                                <select name="dosen_id" id="dosen_id" class="form-select">
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach($dosens as $d)
                                        <option value="{{ $d->id }}" {{ ($d->id == $pendaftaran->user->dosen_id) ? 'selected' : '' }}>{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" id="paket">
                            <label for="paket">Paket Kuliah </label>
                            @foreach ($paket as $p)
                                <div class="col-md-4">
                                    <div class="alert alert-secondary">
                                        <h4 class="alert-heading">Semester {{ $p->semester }}</h4>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="paket" value="{{ $p->id }}"
                                                id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                {{ $p->nama_paket }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/herreg" id="close" class="btn btn-light-secondary">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </a>
                        <button id="save" type="button" class="btn btn-success ms-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Konfirmasi</span>
                        </button>
                        <button class="btn btn-success spinner" id="loading" style="display: none;" type="button"
                            disabled="">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @includeIf('herregistrasi.modal')
</div>
@endsection

@push('script')
    <script>

        $(document).ready(function () {
        }).on('click','#save', function() {
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
                url: "/herreg",
                type: 'POST',
                data: data,
                success: function (result) {
                    if (result.success) {
                        successMsg(result.success)
                        $('.spinner').css('display', 'none');
                        $('#save').css('display', 'block');
                        $('#form').find('input').val('');
                        window.location.replace('/herreg')
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

    </script>
@endpush
