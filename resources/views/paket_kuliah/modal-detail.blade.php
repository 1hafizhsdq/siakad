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
                    {{-- <ul class="list-group">
                        <li class="list-group-item">
                            <input id="checkbox-1" class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                            <label for="checkbox-1">Cras justo odio</label>
                        </li>
                        <li class="list-group-item">
                            <input id="checkbox-2" class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                            <label for="checkbox-2">Dapibus ac facilisis in</label>
                        </li>
                        <li class="list-group-item">
                            <input id="checkbox-3" class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                            <label for="checkbox-3">Morbi leo risus</label>
                        </li>
                        <li class="list-group-item">
                            <input id="checkbox-4" class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                            <label for="checkbox-4">Porta ac consectetur ac</label>
                        </li>
                        <li class="list-group-item">
                            <input id="checkbox-5" class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                            <label for="checkbox-5">Vestibulum at eros</label>
                        </li>
                        <li class="list-group-item">
                            <input id="checkbox-6" class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                            <label for="checkbox-6">Vestibulum at eros</label>
                        </li>
                        <li class="list-group-item">
                            <input id="checkbox-7" class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                            <label for="checkbox-7">Vestibulum at eros</label>
                        </li>
                    </ul> --}}
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
