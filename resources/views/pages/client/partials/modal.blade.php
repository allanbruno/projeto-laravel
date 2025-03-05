<!-- Modal de Cadastro/Edição -->
        <div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="clienteForm" method="POST">
                @csrf
                <input type="hidden" name="_method" value="POST" id="method">
                <div class="modal-header">
                    <h5 class="modal-title" id="clienteModalLabel">Cadastrar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text"
                               class="form-control"
                               id="name"
                               name="name"
                               required>
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                               class="form-control"
                               id="email"
                               name="email"
                               required>
                        <div class="invalid-feedback" id="email-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefone</label>
                        <input type="text"
                               class="form-control"
                               id="phone"
                               name="phone"
                               required>
                        <div class="invalid-feedback" id="phone-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select"
                                id="status"
                                name="status"
                                required>
                            <option value="active">Ativo</option>
                            <option value="inactive">Inativo</option>
                        </select>
                        <div class="invalid-feedback" id="status-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .modal-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
        }
    </style>
@endpush
