<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;

class DeleteConfirmation extends Component
{
    public $isOpen = false;
    public $clientId;
    public $clientName;
    public $message;

    protected $listeners = ['confirmDelete' => 'openModal'];

    public function render()
    {
        return view('livewire.client.delete-confirmation');
    }

    public function openModal($clientId)
    {
        $this->message = null;
        $client = Client::findOrFail($clientId);
        $this->clientId = $client->id;
        $this->clientName = $client->name;
        $this->isOpen = true;
        $this->dispatch('openDeleteModal');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['clientId', 'clientName']);
        $this->dispatch('closeDeleteModal');
    }

    public function delete()
    {
        try {
            $client = Client::findOrFail($this->clientId);
            $client->delete();

            $this->message = 'Cliente excluído com sucesso!';
            $this->dispatch('client-deleted');
            $this->dispatch('client-list-updated');
            $this->closeModal();

        } catch (\Exception $e) {
            $this->message = 'Erro ao excluir cliente: ' . $e->getMessage();
        }
    }
}
