    <!-- Modal -->
    <div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe src="{{ asset('file/dialog.php?field_id=' . $fieldId . '') }}" frameborder="0"
                        class="w-100" height="400px"></iframe>
                </div>
            </div>
        </div>
    </div>
