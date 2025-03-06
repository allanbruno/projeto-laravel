<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;

class ClientForm extends Component
{
    public $clientId;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $status = 'active';
    public $isOpen = false;
    public $message;
    public $errorMessage;
    public $isEditing = false;
    public $isViewing = false;

    protected $listeners = [
        'edit-client' => 'editClient',
        'view-client' => 'viewClient',
        'resetMessage' => 'resetMessage'
    ];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $this->clientId,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function render()
    {
        return view('livewire.client.client-form');
    }

    public function openModal($clientId = null)
    {
        $this->resetForm();

        if ($clientId) {
            $this->loadClient($clientId);
            $this->isEditing = true;
        }

        $this->dispatch('openModal');
        $this->isOpen = true;
    }

    public function loadClient($clientId)
    {
        $client = Client::findOrFail($clientId);
        $this->clientId = $client->id;
        $this->name = $client->name;
        $this->email = $client->email;
        $this->phone = $client->phone;
        $this->address = $client->address;
        $this->status = $client->status;
    }

    public function save()
    {
        logger('Método save iniciado');

        try {
            $validated = $this->validate();

            if ($this->isEditing) {
                $client = Client::findOrFail($this->clientId);
                $client->update($validated);
                $this->message = 'Cliente atualizado com sucesso!';
            } else {
                $client = Client::create($validated);
                $this->message = 'Cliente cadastrado com sucesso!';
            }

            $this->dispatch('client-saved');
            $this->closeModal();
            $this->dispatch('client-list-updated');

        } catch (\Exception $e) {
            $this->errorMessage = 'Erro ao ' . ($this->isEditing ? 'atualizar' : 'cadastrar') . ' cliente: ' . $e->getMessage();
            $this->dispatch('save-error');
        }
    }

    public function editClient($clientId)
    {
        $this->openModal($clientId);
    }

    public function viewClient($clientId)
    {
        $this->loadClient($clientId);
        $this->isViewing = true;
        $this->isEditing = false;
        $this->dispatch('openModal');
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
        $this->isOpen = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['clientId', 'name', 'email', 'address', 'phone', 'isEditing', 'isViewing']);
        $this->status = 'active';
        $this->errorMessage = null;
        $this->resetValidation();
    }

    public function resetMessage() {
        $this->message = null;
    }
}
