@extends('layouts.app')

@section('title', 'Listagem de clientes')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Clientes</h1>
            <livewire:client.client-form />
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route('client.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Buscar por nome, email ou telefone..."
                               value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
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
                                        <a href=""
                                           class="btn btn-sm"
                                           title="Visualizar"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href=""
                                           title="Editar"
                                           class="btn btn-sm"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action=""
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm"
                                                    title="Excluir"
                                                    onclick="return confirm('Tem certeza que deseja excluir?')"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="alert alert-info mb-0">
                                        Nenhum usuário encontrado.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    @if($clients instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{ $clients->withQueryString()->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
