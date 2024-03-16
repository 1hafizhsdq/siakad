<div class="modal modal-lg fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title"></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="form">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <label for="user_id">Dosen </label>
                    <div class="form-group">
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="">-- Pilih Dosen --</option>
                            @foreach ($dosens as $d)
                                <option value="{{ $d->id }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="matkul_id">Matkul </label>
                    <div class="form-group">
                        <select name="matkul_id" id="matkul_id" class="form-select">
                        </select>
                    </div>
                    <label for="ruangan_id">Ruangan </label>
                    <div class="form-group">
                        <select name="ruangan_id" id="ruangan_id" class="form-select">
                            <option value="">-- Pilih Dosen --</option>
                            @foreach ($ruangans as $r)
                                <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="hari">Hari </label>
                    <div class="form-group">
                        <select name="hari" id="hari" class="form-select">
                            <option value="">-- Pilih Hari --</option>
                            <option value="SENIN">SENIN</option>
                            <option value="SELASA">SELASA</option>
                            <option value="RABU">RABU</option>
                            <option value="KAMIS">KAMIS</option>
                            <option value="JUMAT">JUMAT</option>
                            <option value="SABTU">SABTU</option>
                            <option value="MINGGU">MINGGU</option>
                        </select>
                    </div>
                    <label for="jam_perkuliahan_id">Jam Perkuliahan </label>
                    <div class="form-group">
                        <select name="jam_perkuliahan_id" id="jam_perkuliahan_id" class="form-select">
                            <option value="">-- Pilih Jam Perkuliahan --</option>
                            @foreach ($jam_perkuliahans as $jp)
                                <option value="{{ $jp->id }}">{{ $jp->mulai }} - {{ $jp->selesai }} ( JAM KE {{ $jp->jam_ke }} )</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
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
</div>
