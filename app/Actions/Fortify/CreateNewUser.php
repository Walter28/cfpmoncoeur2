<?php

namespace App\Actions\Fortify;

use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     * Automatically creates an Etudiant profile for any public registration.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms'    => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            // 1. Create the user account with etudiant role
            $user = User::create([
                'name'              => $input['name'],
                'email'             => $input['email'],
                'password'          => Hash::make($input['password']),
                'role'              => 'etudiant',
                'email_verified_at' => now(),
            ]);

            // 2. Automatically create the linked Etudiant profile
            // Split "Prénom Nom" → prenom = first word, nom = rest
            $parts  = explode(' ', trim($input['name']), 2);
            $prenom = $parts[0] ?? $input['name'];
            $nom    = $parts[1] ?? $prenom;

            Etudiant::create([
                'user_id' => $user->id,
                'nom'     => $nom,
                'prenom'  => $prenom,
                'email'   => $input['email'],
            ]);

            return $user;
        });
    }
}
