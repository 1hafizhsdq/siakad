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
                        <span>Silahkan lakukan pembayaran Biaya Herregistrasi melalui transfer
                            Bank BCA a/n Sekolah Tinggi Agama Islam Nahdlatul Ulama
                            Pacitan</span>
                        <div class="alert alert-light-secondary color-secondary mt-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <img width="200px" height="150px"
                                        src="{{ asset('dist') }}/assets/compiled/png/bca.png"
                                        alt="Logo">
                                </div>
                                <div class="col-md-8">
                                    <h3 class="mt-5">No. Rekening : 0181944884</h3>
                                    <h3>a/n Sekolah Tinggi Agama Islam Nahdlatul Ulama Pacitan
                                    </h3>
                                </div>
                            </div>
                            <hr>
                            <h5>Biaya Pendaftaran Calon Mahasiswa sejumlah Rp. 600.000,-</h5>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <label for="file_herregistrasi">Bukti Pembayaran</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="file"
                                    class="image-preview-filepond @error('file_herregistrasi') is-invalid @enderror"
                                    id="file_herregistrasi" name="file_herregistrasi">
                                <small>File bertipe jpg/jpeg/png, maksimal berukuran 2MB</small>
                            </div>
                            <div class="col-md-4">
                                <label for="tahun_ajaran_id">Tahun Ajaran</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="tahun_ajaran_id" name="tahun_ajaran_id">
                                    @foreach($tahun_ajarans as $th)
                                        <option value="{{ $th->id }}"
                                            {{ ($th->is_active == 1) ? 'selected' : '' }}>
                                            {{ $th->nama_tahun_ajaran }} {{ $th->semester }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="semester">Semester </label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="form-group">
                                    <input id="semester" name="semester" type="text" placeholder="Cth : 1"
                                        onkeypress="return isNumber(event)" class="form-control">
                                </div>
                            </div>
                            <input type="hidden" name="prodi_id" value="{{ $last_pendaftaran->prodi_id }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/herreg" id="close" type="button" class="btn btn-light-secondary">
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
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
        }).on('click', '#save', function () {
            var form = $('#form')[0],
                data = new FormData(form);

            $('.spinner').css('display', 'block');
            $(this).css('display', 'none');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/herregistrasi-store",
                type: 'POST',
                processData: false,
                contentType: false,
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
                }
            });
        });

    </script>
@endpush
