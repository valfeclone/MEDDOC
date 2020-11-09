<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewAdmins;

class CreateNewAdmin implements CreatesNewAdmins
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered admin.
     *
     * @param  array  $input
     * @return \App\Models\Admin
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => $this->passwordRules(),
        ])->validate();

        return Admin::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
