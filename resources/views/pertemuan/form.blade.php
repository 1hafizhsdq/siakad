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
                    Informasi Pertemuan
                </h5>
            </div>
            <div class="card-body">
                <form id="form" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" id="id" value="{{ $pertemuan->id ?? '' }}">
                            <div class="col-md-4">
                                <label for="pertemuan_ke">Pertemuan Ke- <small class="text-danger">*</small></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="form-group">
                                    <input id="pertemuan_ke" name="pertemuan_ke" type="text" placeholder="Cth : 1"
                                        onkeypress="return isNumber(event)" class="form-control" value="{{ $pertemuan->pertemuan_ke ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="jenis_perkuliahan_id">Jenis Pertemuan <small class="text-danger">*</small></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="jenis_perkuliahan_id" name="jenis_perkuliahan_id">
                                    @foreach($jenis_perkuliahans as $jp)
                                        <option value="{{ $jp->id }}" {{ (!empty($pertemuan)) ? ($pertemuan->jenis_perkuliahan_id == $jp->id) ? 'selected' : '' : '' }}>{{ $jp->jenis_perkuliahan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="tahun_ajaran_id">Tahun Ajaran <small class="text-danger">*</small></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="tahun_ajaran_id" name="tahun_ajaran_id">
                                    @foreach($tahunajarans as $th)
                                        @if (!empty($pertemuan))
                                            <option value="{{ $th->id }}"
                                                {{ ($th->is_active == 1 || $pertemuan->tahun_ajaran_id == $th->id) ? 'selected' : '' }}>
                                                {{ $th->nama_tahun_ajaran }} {{ $th->semester }}</option>
                                        @else
                                            <option value="{{ $th->id }}"
                                                {{ ($th->is_active == 1) ? 'selected' : '' }}>
                                                {{ $th->nama_tahun_ajaran }} {{ $th->semester }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="prodi_id">Program Studi <small class="text-danger">*</small></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="prodi_id" name="prodi_id">
                                    <option value="">-- Pilih Program Studi --</option>
                                    @foreach($prodis as $pd)
                                        <option value="{{ $pd->id }}" {{ (!empty($pertemuan)) ? ($pertemuan->prodi_id == $pd->id) ? 'selected' : '' : '' }}>{{ $pd->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="matkul_id">Mata Kuliah <small class="text-danger">*</small></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="matkul_id" name="matkul_id">
                                    @if (!empty($pertemuan))
                                        @foreach ($matkuls as $mk)
                                            <option value="{{ $mk->id }}" {{ ($mk->id == $pertemuan->matkul_id) ? 'selected' : '' }}>{{ $mk->mata_kuliah }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <hr>
                            <div class="col-md-4">
                                <label for="jadwal_id">Jadwal Kuliah <small class="text-danger">*</small></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="jadwal_id" name="jadwal_id">
                                    @if (!empty($pertemuan))
                                        @foreach ($jadwals as $jd)
                                            <option value="{{ $jd->id }}" {{ ($jd->id == $pertemuan->jadwal_id) ? 'selected' : '' }}>{{ $jd->hari }} ( {{ $jd->jam_perkuliahan->mulai }} - {{ $jd->jam_perkuliahan->selesai }} )</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="sks">SKS</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="form-group">
                                    <input id="sks" name="sks" type="text" class="form-control" value="{{ $pertemuan->matkul->sks ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="dosen_id">Nama Dosen</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="dosen_id" name="dosen_id">
                                    @if (!empty($pertemuan))
                                        <option value="">-- Pilih Dosen --</option>
                                        <option value="{{ $pertemuan->dosen_id }}" selected>{{ $pertemuan->dosen->nama }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="waktu">Jam</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="waktu_mulai">Mulai</label>
                                            <input type="time" id="waktu_mulai" class="form-control" name="waktu_mulai" value="{{ $pertemuan->waktu_mulai ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="waktu_selesai">Selesai</label>
                                            <input type="time" id="waktu_selesai" class="form-control" name="waktu_selesai" value="{{ $pertemuan->waktu_selesai ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="ruangan_id" id="ruangan_id" value="{{ $pertemuan->ruangan_id ?? '' }}">
                            <hr>
                            <div class="col-md-4">
                                <label for="tgl_pertemuan">Tanggal Pertemuan <small class="text-danger">*</small></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="form-group">
                                    <input id="tgl_pertemuan" name="tgl_pertemuan" type="date" class="form-control" value="{{ $pertemuan->tgl_pertemuan ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="lokasi">Lokasi</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="form-group">
                                    <input id="lokasi" name="lokasi" type="text" class="form-control" value="{{ $pertemuan->lokasi ?? '' }}">
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-4">
                                <label for="rencana_materi">Rencana Materi</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="form-group">
                                    <input id="rencana_materi" name="rencana_materi" type="text" class="form-control" value="{{ $pertemuan->rencana_materi ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="realisasi_materi">Realisasi Materi</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="form-group">
                                    <input id="realisasi_materi" name="realisasi_materi" type="text" class="form-control" value="{{ $pertemuan->realisasi_materi ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="materi">Materi</label>
                            </div>
                            @if (!empty($pertemuan) && !empty($pertemuan->materi))
                                <div class="col-md-8 form-group">
                                    <div class="form-group">
                                        <a href="/materi/{{ $pertemuan->materi }}" target="_blank">Lihat Materi</a>
                                        <a href="#" id="del-materi" type="button" class="btn btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-8 form-group">
                                    <input type="file"
                                        class="basic-filepond"
                                        id="materi" name="materi">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/pertemuan" id="close" type="button" class="btn btn-light-secondary">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </a>
                        <button id="save" type="button" class="btn btn-success ms-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
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
                url: "/pertemuan",
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
                        setInterval(function () {
                            window.location.replace('/pertemuan');
                        }, 2000);
                    } else {
                        $('.spinner').css('display', 'none');
                        $('#save').css('display', 'block');
                        $.each(result.errors, function (key, value) {
                            errorMsg(value)
                        });
                    }
                }
            });
        }).on('change', '#prodi_id', function(){
            $.ajax({
                url: "/pertemuan-matkul/"+$(this).val(),
                type: 'GET',
                success: function(result) {
                    $('#matkul_id').html('');
                    var matkul = '<option>-- Pilih Mata Kuliah --</option>';
                    $.each(result, function (key, value) {
                        matkul += "<option value='"+value.id+"'>"+value.mata_kuliah+"</option>"
                    });
                    $('#matkul_id').html(matkul);
                }
            });
        }).on('change', '#matkul_id', function(){
            $.ajax({
                url: "/pertemuan-jadwal/"+$(this).val()+"/{{ $user->id }}",
                type: 'GET',
                success: function(result) {
                    $('#jadwal_id').html('');
                    var jadwal = '<option>-- Pilih Jadwal Kuliah --</option>';
                    $.each(result, function (key, value) {
                        jadwal += "<option value='"+value.id+"'>"+value.hari+" - ("+value.jam_perkuliahan.mulai+" - "+value.jam_perkuliahan.selesai+")</option>"
                    });
                    $('#jadwal_id').html(jadwal);
                }
            });
        }).on('change', '#jadwal_id', function(){
            $.ajax({
                url: "/pertemuan-jadwal-find/"+$(this).val(),
                type: 'GET',
                success: function(result) {
                    console.log(result.matkul.sks);
                    $('#dosen_id').html('<option value="'+result.user_id+'" selected>'+result.dosen.nama+'</option>');
                    $('#waktu_mulai').val(result.jam_perkuliahan.mulai);
                    $('#waktu_selesai').val(result.jam_perkuliahan.selesai);
                    $('#ruangan_id').val(result.ruangan_id);
                    $('#sks').val(result.matkul.sks);
                }
            });
        }).on('click', '#del-materi', function(){
            $.ajax({
                url: "/pertemuan-del-materi/{{ $pertemuan->id }}",
                type: 'GET',
                success: function(result) {
                    setInterval(function () {
                        successMsg(result.success);
                    }, 2000);
                    location.reload()
                }
            });
        });

    </script>
@endpush
