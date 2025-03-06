<div>
    @if ($message)
        <div id="alert-deleted" class="alert alert-success alert-dismissible fade show position-fixed top-10 start-50 translate-middle"
             role="alert" style="z-index: 1050;">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="modal fade" id="deleteModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-medium">Tem certeza que deseja excluir o cliente "{{ $clientName }}"?</p>
                    <p class="text-danger fw-bolder"><small>Esta ação não poderá ser desfeita.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancelar</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Excluir</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('openDeleteModal', () => {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        });

        Livewire.on('closeDeleteModal', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
            if (modal) {
                modal.hide();

                setTimeout(function () {
                    document.getElementById('alert-deleted').remove();
                }, 1000);
            }
        });
    });
</script>
