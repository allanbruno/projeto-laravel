<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Attributes\On;
use Livewire\Component;

class ClientForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $status = 'active';
    public $isOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:client,email',
        'phone' => 'required|string|max:20',
        'status' => 'required|in:active,inactive',
    ];

    public function render()
    {
        return view('livewire.client.client-form');
    }

    public function openModal()
    {
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
        $this->validate();

        try {
            Client::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'status' => $this->status,
            ]);

            $this->closeModal();
            $this->dispatch('client-saved');
            session()->flash('message', 'Cliente cadastrado com sucesso!');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao cadastrar cliente.');
        }
    }

    private function resetForm()
    {
        $this->reset(['name', 'email', 'phone']);
        $this->status = 'active';
        $this->resetValidation();
    }
}
