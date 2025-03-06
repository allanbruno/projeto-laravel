<div>
    <div class="card">
        <div class="card-body">
            <form class="mb-4">
                <div class="input-group">
                    <input type="text"
                           wire:model.live="search"
                           class="form-control"
                           placeholder="Buscar por nome, email ou telefone...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{!! $client->status_badge !!}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-sm"
                                            title="Visualizar"
                                            wire:click="$dispatch('view-client', [{{ $client->id }}])">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button"
                                            class="btn btn-sm"
                                            title="Editar"
                                            wire:click="$dispatch('edit-client', [{{ $client->id }}])"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button"
                                            class="btn btn-sm"
                                            title="Excluir"
                                            wire:click="$dispatch('confirmDelete', [{{ $client->id }}])">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                Nenhum cliente encontrado.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</div>
