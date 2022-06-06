<div class="modal fade" id="{{ $idModal }}" tabindex="-1" role="dialog" data-bs-backdrop="static"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="alert" class="alert alert-danger row d-none">
                </div>
                <input type="hidden" class="id_hidden">
                <div class="row">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="{{ $name }}" placeholder="Nhập tên danh mục">
                </div>
                <div class="status d-none">
                    <div class="d-flex">
                        <label for="" class="mt-2">Status</label>
                        <div class="form-check mx-3">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input public edit_status" name="status" value="1">
                                Public
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input private edit_status" name="status"
                                    value="0">
                                Private
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="{{ $select }}" class="form-label">Chọn danh mục cha</label>
                    <select class="form-control select" id="{{ $select }}">
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary {{ $button }}">Save</button>
            </div>
        </div>
    </div>
</div>
