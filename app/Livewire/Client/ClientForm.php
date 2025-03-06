<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ClientForm extends Component
{
    use WithFileUploads;

    public $clientId;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $status = 'active';
    public $image;
    public $oldImage;
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
            'image' => $this->isEditing ? 'nullable|image|max:1024' : 'required|image|max:1024',
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
        $this->oldImage = $client->image;
    }

    public function save()
    {
        try {
            $validated = $this->validate();

            if ($this->image) {
                $imagePath = $this->image->store('clients', 'public');
                $validated['image'] = $imagePath;

                if ($this->isEditing && $this->oldImage) {
                    Storage::disk('public')->delete($this->oldImage);
                }
            }

            if ($this->isEditing) {
                $client = Client::findOrFail($this->clientId);
                $client->update($validated);
                $this->message = 'Cliente atualizado com sucesso!';
            } else {
                Client::create($validated);
                $this->message = 'Cliente cadastrado com sucesso!';
            }

            $this->dispatch('client-saved');
            $this->closeModal();
            $this->dispatch('client-list-updated');

        } catch (\Exception $e) {
            $this->errorMessage =
                'Erro ao ' .
                ($this->isEditing ? 'atualizar' : 'cadastrar')
                . ' cliente: '
                . ' Verifique se os campos estão corretos.';
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
        $this->reset(['clientId', 'name', 'email', 'address', 'phone', 'image', 'oldImage', 'isEditing', 'isViewing']);
        $this->status = 'active';
        $this->errorMessage = null;
        $this->resetValidation();
    }

    public function resetMessage() {
        $this->message = null;
    }
}
