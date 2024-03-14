<div class="modal fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
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
                    <label for="jam_ke">Jam Ke </label>
                    <div class="form-group">
                        <input id="jam_ke" name="jam_ke" type="text" onkeypress="return isNumber(event)" placeholder="Contoh : 1" class="form-control">
                    </div>
                    <label for="mulai">Mulai </label>
                    <div class="form-group">
                        <input id="mulai" name="mulai" type="time" onkeypress="return isNumber(event)" class="form-control">
                    </div>
                    <label for="selesai">Selesai </label>
                    <div class="form-group">
                        <input id="selesai" name="selesai" type="time" onkeypress="return isNumber(event)" class="form-control">
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
