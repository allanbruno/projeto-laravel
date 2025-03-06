@extends('layouts.app')

@section('title', 'Listagem de clientes')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Clientes</h1>
            <livewire:client.client-form />
        </div>
        <livewire:client.client-table />
    </div>
@endsection
