<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;

class ClientForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $status = 'active';
    public $isOpen = false;
    public $message;
    public $errorMessage;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:clients,email',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
    ];

    public function render()
    {
        return view('livewire.client.client-form');
    }

    public function openModal()
    {
        $this->message = null;
        $this->resetForm();
        $this->dispatch('openModal');
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
        $this->isOpen = false;
        $this->resetForm();
    }

    public function save()
    {
        logger('Método save iniciado');

        try {
            $validated = $this->validate();
            logger('Dados validados:', $validated);

            $client = Client::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'status' => $this->status,
            ]);

            logger('Cliente criado:', ['id' => $client->id]);

            $this->message = 'Cliente cadastrado com sucesso!';
            $this->dispatch('client-saved');
            $this->closeModal();
            $this->dispatch('client-list-updated');

        } catch (\Exception $e) {
            $this->errorMessage = 'Erro ao cadastrar cliente: ' . $e->getMessage();
            $this->dispatch('save-error');
        }
    }

    private function resetForm()
    {
        $this->reset(['name', 'email', 'address', 'phone']);
        $this->status = 'active';
        $this->errorMessage = null;
        $this->resetValidation();
    }
}
