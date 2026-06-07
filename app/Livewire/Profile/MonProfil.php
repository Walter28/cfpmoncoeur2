<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class MonProfil extends Component
{
    public string $name  = '';
    public string $email = '';

    public string $currentPassword          = '';
    public string $newPassword              = '';
    public string $newPasswordConfirmation  = '';

    public ?string $profileSuccess  = null;
    public ?string $profileError    = null;
    public ?string $passwordSuccess = null;
    public ?string $passwordError   = null;

    public function mount(): void
    {
        $this->name  = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function updateProfile(): void
    {
        $this->profileSuccess = null;
        $this->profileError   = null;

        $this->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->update([
            'name'  => $this->name,
            'email' => $this->email,
        ]);

        $this->profileSuccess = 'Profil mis à jour avec succès.';
    }

    public function updatePassword(): void
    {
        $this->passwordSuccess = null;
        $this->passwordError   = null;

        $this->validate([
            'currentPassword' => 'required',
            'newPassword'     => 'required|min:8|confirmed',
        ]);

        if (! Hash::check($this->currentPassword, auth()->user()->password)) {
            $this->passwordError = 'Le mot de passe actuel est incorrect.';
            return;
        }

        auth()->user()->update([
            'password' => Hash::make($this->newPassword),
        ]);

        $this->currentPassword         = '';
        $this->newPassword             = '';
        $this->newPasswordConfirmation = '';
        $this->passwordSuccess         = 'Mot de passe changé avec succès.';
    }

    public function render()
    {
        return view('livewire.profile.mon-profil')
            ->layout('layouts.defaultfrontend', ['title' => 'Mon Profil']);
    }
}
