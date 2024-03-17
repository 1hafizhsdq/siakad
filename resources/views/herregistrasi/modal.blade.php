<div class="modal modal-xl fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
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
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="userid" id="userid">
                        <input type="hidden" name="prodi_id" id="prodi_id">
                        <label for="nim">NIM </label>
                        <div class="form-group">
                            <input id="nim" name="nim" type="text" class="form-control">
                        </div>
                        <label for="semester">Semester </label>
                        <div class="form-group">
                            <input id="semester" name="semester" type="text" class="form-control" readonly>
                        </div>
                        <label for="dosen_id">Dosen Wali </label>
                        <div class="form-group">
                            <select name="dosen_id" id="dosen_id" class="form-select">
                                <option value="">-- Pilih Dosen --</option>
                                @foreach($dosens as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" id="paket">
                        <div class="col-md-4">
                            <div class="alert alert-secondary">
                                <h4 class="alert-heading">Semester 1</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Nama Paket
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
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
</div>
