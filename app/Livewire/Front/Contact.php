<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\ContactMessage;

class Contact extends Component
{
    public string $nom      = '';
    public string $email    = '';
    public string $telephone = '';
    public string $sujet    = '';
    public string $message  = '';
    public bool   $sent     = false;

    protected array $rules = [
        'nom'       => 'required|string|max:100',
        'email'     => 'required|email|max:150',
        'telephone' => 'nullable|string|max:30',
        'sujet'     => 'required|string|max:200',
        'message'   => 'required|string|min:20|max:2000',
    ];

    protected array $messages = [
        'nom.required'      => 'Votre nom est obligatoire.',
        'email.required'    => 'Votre adresse email est obligatoire.',
        'email.email'       => 'Veuillez entrer une adresse email valide.',
        'sujet.required'    => 'Le sujet est obligatoire.',
        'message.required'  => 'Votre message est obligatoire.',
        'message.min'       => 'Le message doit contenir au moins 20 caractères.',
    ];

    public function send(): void
    {
        $this->validate();

        ContactMessage::create([
            'nom'       => trim($this->nom),
            'email'     => trim($this->email),
            'telephone' => trim($this->telephone) ?: null,
            'sujet'     => trim($this->sujet),
            'message'   => trim($this->message),
        ]);

        $this->reset(['nom', 'email', 'telephone', 'sujet', 'message']);
        $this->sent = true;
    }

    public function resetForm(): void
    {
        $this->sent = false;
    }

    public function render()
    {
        return view('livewire.front.contact')
            ->layout('layouts.defaultfrontend', ['title' => 'Contactez-nous']);
    }
}
