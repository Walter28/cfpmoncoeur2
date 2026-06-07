<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminUsersCrud extends Component
{
    public bool    $showForm = false;
    public ?int    $editId   = null;
    public string  $searchTerm = '';

    public string $name     = '';
    public string $email    = '';
    public string $password = '';
    public string $role     = 'super admin';

    const ROLES = [
        'super admin' => ['label' => 'Super Admin',  'color' => '#ef4444', 'bg' => 'rgba(239,68,68,.1)',   'icon' => 'bi-shield-fill-check'],
        'formateur'   => ['label' => 'Formateur',    'color' => '#4f46e5', 'bg' => 'rgba(79,70,229,.1)',   'icon' => 'bi-person-video3'],
        'etudiant'    => ['label' => 'Étudiant',     'color' => '#10b981', 'bg' => 'rgba(16,185,129,.1)',  'icon' => 'bi-mortarboard-fill'],
        'user'        => ['label' => 'Utilisateur',  'color' => '#64748b', 'bg' => 'rgba(100,116,139,.1)', 'icon' => 'bi-person-fill'],
    ];

    protected function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email' . ($this->editId ? ",{$this->editId}" : ''),
            'password' => $this->editId ? 'nullable|min:6' : 'required|min:6',
            'role'     => 'required|in:super admin,formateur,etudiant,user',
        ];
    }

    public function updatedSearchTerm(): void
    {
        $this->resetPage();
    }

    protected function resetPage(): void {}

    public function render()
    {
        $query = User::query()
            ->when($this->searchTerm, fn($q) => $q->where('name', 'like', "%{$this->searchTerm}%")
                ->orWhere('email', 'like', "%{$this->searchTerm}%"))
            ->orderByRaw("CASE role
                WHEN 'super admin' THEN 0
                WHEN 'formateur'   THEN 1
                WHEN 'etudiant'    THEN 2
                ELSE 3 END")
            ->orderBy('name')
            ->get();

        $counts = [
            'all'        => User::count(),
            'super admin'=> User::where('role', 'super admin')->count(),
            'formateur'  => User::where('role', 'formateur')->count(),
            'etudiant'   => User::where('role', 'etudiant')->count(),
            'user'       => User::where('role', 'user')->count(),
        ];

        return view('livewire.admin-users-crud', compact('query', 'counts'))
            ->layout('layouts.defaultbackend', ['title' => 'Gestion des utilisateurs']);
    }

    public function openCreate(): void
    {
        $this->reset(['name', 'email', 'password', 'editId']);
        $this->role     = 'etudiant';
        $this->showForm = true;
    }

    public function editAdmin(int $id): void
    {
        $user = User::findOrFail($id);
        $this->editId   = $id;
        $this->name     = $user->name;
        $this->email    = $user->email;
        $this->role     = $user->role;
        $this->password = '';
        $this->showForm = true;
    }

    public function changeRole(int $id, string $role): void
    {
        if (!array_key_exists($role, self::ROLES)) return;
        if ($id === Auth::id() && $role !== 'super admin') {
            $this->dispatch('showAlert', ['type' => 'error', 'message' => 'Vous ne pouvez pas rétrograder votre propre compte.']);
            return;
        }
        User::findOrFail($id)->update(['role' => $role]);
        $this->dispatch('showAlert', ['type' => 'success', 'message' => 'Rôle mis à jour : ' . (self::ROLES[$role]['label'] ?? $role)]);
    }

    public function save(): void
    {
        $this->validate();

        if ($this->editId) {
            $user = User::findOrFail($this->editId);
            $data = ['name' => $this->name, 'email' => $this->email, 'role' => $this->role];
            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }
            $user->update($data);
            $this->dispatch('showAlert', ['type' => 'success', 'message' => 'Utilisateur modifié avec succès.']);
        } else {
            User::create([
                'name'              => $this->name,
                'email'             => $this->email,
                'password'          => Hash::make($this->password),
                'role'              => $this->role,
                'email_verified_at' => now(),
            ]);
            $this->dispatch('showAlert', ['type' => 'success', 'message' => 'Utilisateur créé avec succès.']);
        }

        $this->showForm = false;
        $this->reset(['name', 'email', 'password', 'role', 'editId']);
    }

    public function deleteAdmin(int $id): void
    {
        if ($id === Auth::id()) {
            $this->dispatch('showAlert', ['type' => 'error', 'message' => 'Vous ne pouvez pas supprimer votre propre compte.']);
            return;
        }
        User::findOrFail($id)->delete();
        $this->dispatch('showAlert', ['type' => 'success', 'message' => 'Utilisateur supprimé.']);
    }

    public function cancelForm(): void
    {
        $this->showForm = false;
        $this->reset(['name', 'email', 'password', 'role', 'editId']);
        $this->resetErrorBag();
    }
}
