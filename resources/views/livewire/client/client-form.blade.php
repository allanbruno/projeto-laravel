<div>
    @if ($message)
        <div id="alert-inserted" class="alert alert-success alert-dismissible fade show position-fixed top-10 start-50 translate-middle"
             role="alert" style="z-index: 1050;"
        >
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <button type="button" class="btn btn-primary" wire:click="openModal">
        <i class="fas fa-plus"></i> Novo Cliente
    </button>
    <div class="modal fade" id="clienteModal" tabindex="-1"
         wire:ignore.self
         data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit="save">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            @if($isViewing)
                                Visualizar Cliente
                            @else
                                {{ $isEditing ? 'Editar Cliente' : 'Cadastrar Cliente' }}
                            @endif
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="image" class="form-label">Foto do Cliente</label>
                            <input type="file"
                                   class="form-control @error('image') is-invalid @enderror"
                                   id="image"
                                   wire:model="image"
                                   accept="image/*"
                                   @if($isViewing) disabled @endif
                            >
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}"
                                         class="img-thumbnail"
                                         style="max-height: 100px"
                                         alt="Preview da nova imagem"
                                    >
                                @elseif ($oldImage)
                                    <img src="{{ Storage::url($oldImage) }}"
                                         class="img-thumbnail"
                                         style="max-height: 100px"
                                         alt="Imagem atual"
                                    >
                                @else
                                    <p class="text-muted">Nenhuma imagem selecionada</p>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            @if ($errorMessage)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $errorMessage }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   wire:model="name"
                                   @if($isViewing) disabled @endif
                            >
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   wire:model="email"
                                   @if($isViewing) disabled @endif
                            >
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   id="phone"
                                   maxlength="15"
                                   wire:model="phone"
                                   @if($isViewing) disabled @endif
                            >
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Endereço</label>
                            <input type="text"
                                   class="form-control @error('address') is-invalid @enderror"
                                   id="address"
                                   wire:model="address"
                                   @if($isViewing) disabled @endif
                            >
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status"
                                    wire:model="status"
                                    @if($isViewing) disabled @endif
                            >
                                <option value="active">Ativo</option>
                                <option value="inactive">Inativo</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                wire:click="closeModal"
                        >
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                        @unless($isViewing)
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ $isEditing ? 'Atualizar' : 'Salvar' }}
                            </button>
                        @endunless
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function () {
                const modalElement = document.getElementById('clienteModal');
                const modal = new bootstrap.Modal(modalElement);

                Livewire.on('openModal', () => {
                    modal.show();
                });

                Livewire.on('closeModal', () => {
                    modal.hide();

                    setTimeout(() => {
                        document.getElementById('alert-inserted').remove();
                        Livewire.dispatch('resetMessage');
                    }, 1000);
                });
            });

            document.addEventListener('livewire:initialized', function () {
                new Cleave('#phone', {
                        blocks: [0, 2, 5, 4],
                        delimiters: ['(', ') ', '-'],
                        numericOnly: true,
                        onValueChanged: function (e) {
                        @this.set('phone', e.target.value);
                    }
                });
            });
        </script>
    @endpush
</div>
