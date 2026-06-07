<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactMessage;
use Livewire\WithPagination;

class ContactMessagesCrud extends Component
{
    use WithPagination;

    public ?ContactMessage $selected = null;
    public bool $showModal = false;
    public string $search = '';

    protected $queryString = ['search'];

    public function voir(int $id): void
    {
        $this->selected = ContactMessage::findOrFail($id);
        if (! $this->selected->lu) {
            $this->selected->update(['lu' => true]);
        }
        $this->showModal = true;
    }

    public function fermerModal(): void
    {
        $this->showModal = false;
        $this->selected  = null;
    }

    public function supprimer(int $id): void
    {
        ContactMessage::findOrFail($id)->delete();
        $this->dispatch('$refresh');
    }

    public function marquerTousLus(): void
    {
        ContactMessage::where('lu', false)->update(['lu' => true]);
    }

    public function render()
    {
        $messages = ContactMessage::when($this->search, fn($q) =>
                $q->where('nom', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%")
                  ->orWhere('sujet', 'like', "%{$this->search}%")
            )
            ->latest()
            ->paginate(15);

        $totalNonLus = ContactMessage::where('lu', false)->count();

        return view('livewire.contact-messages-crud', compact('messages', 'totalNonLus'))
            ->layout('layouts.defaultbackend', ['title' => 'Messages de contact']);
    }
}
