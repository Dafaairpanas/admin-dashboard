<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Close button positioned absolute -->
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                aria-label="Close" style="z-index: 10;"></button>

            <div class="modal-body text-center p-4 pt-4">
                <div class="mx-auto mb-4 d-flex justify-content-center align-items-center bg-soft-warning rounded-circle"
                    style="width: 80px; height: 80px;">
                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 40px; line-height: 1;"></i>
                </div>

                <h3 class="mb-3 fw-bold">Apakah Anda Yakin?</h3>
                <p class="text-muted font-16 px-4 mb-4">
                    Data yang dihapus tidak dapat dikembalikan lagi. Pastikan Anda sudah memeriksa kembali data yang
                    akan dihapus.
                </p>

                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light btn-lg px-4" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-danger btn-lg px-4 shadow-sm" id="confirmDeleteBtn">
                        <i class="fas fa-trash-alt me-2"></i>Ya, Hapus
                    </button>
                </div>
            </div><!--end modal-body-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let deleteForm = null;
        const deleteModalEl = document.getElementById('deleteConfirmationModal');
        // Check if bootstrap is available, otherwise this might fail if not loaded yet
        // Assuming bootstrap is loaded in app.js
        let deleteModal = null;

        // Delegate click event for dynamic content or just static content
        document.body.addEventListener('submit', function (e) {
            if (e.target.classList.contains('delete-form')) {
                e.preventDefault();
                deleteForm = e.target;

                if (!deleteModal) {
                    deleteModal = new bootstrap.Modal(deleteModalEl);
                }
                deleteModal.show();
            }
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.submit();
            }
        });
    });
</script>