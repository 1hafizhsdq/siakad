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
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <label for="role_id">Role </label>
                    <div class="form-group">
                        <select name="role_id" id="role_id" class="form-select">
                            <option value="">-- Pilih Role --</option>
                            @foreach ($role as $rl)
                                <option value="{{ $rl->id }}">{{ $rl->role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="no_induk">NIP/NIM </label>
                    <div class="form-group">
                        <input id="no_induk" name="no_induk" type="text" placeholder="NIP/NIM" class="form-control" onkeypress="return isNumber(event)">
                    </div>
                    <label for="nama">Nama </label>
                    <div class="form-group">
                        <input id="nama" name="nama" type="text" placeholder="Nama" class="form-control">
                    </div>
                    <label for="email">Email </label>
                    <div class="form-group">
                        <input id="email" name="email" type="text" placeholder="Email" class="form-control">
                    </div>
                    <label for="telp">Telepon (WA) </label>
                    <div class="form-group">
                        <input id="telp" name="telp" type="text" placeholder="Telepon (WA)" class="form-control" onkeypress="return isNumber(event)">
                    </div>
                    <label for="alamat">Alamat </label>
                    <div class="form-group">
                        <input id="alamat" name="alamat" type="text" placeholder="Alamat" class="form-control">
                    </div>
                    <label for="jenis_kelamin">Jenis Kelamin </label>
                    <div class="form-group">
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <label for="ttl">Tempat, Tanggal Lahir </label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="tempat_lahir" name="tempat_lahir" type="text" placeholder="Tempat Lahir" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control">
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
