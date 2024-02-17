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
                    <label for="menu">Menu </label>
                    <div class="form-group">
                        <input id="menu" name="menu" type="text" placeholder="Menu" class="form-control">
                    </div>
                    <label for="url">URL </label>
                    <div class="form-group">
                        <input id="url" name="url" type="text" placeholder="URL" class="form-control">
                    </div>
                    <label for="parent_id">Parent </label>
                    <div class="form-group">
                        <select name="parent_id" id="parent_id" class="form-select"></select>
                    </div>
                    <label for="icon">Icon </label>
                    <div class="form-group">
                        <input id="icon" name="icon" type="text" placeholder="Icon" class="form-control">
                    </div>
                    <label for="sequence">Sequence </label>
                    <div class="form-group">
                        <input id="sequence" name="sequence" type="text" placeholder="Sequence" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button id="save" type="button" class="btn btn-primary ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Submit</span>
                    </button>
                    <button class="btn btn-primary spinner" id="loading" style="display: none;" type="button" disabled="">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
