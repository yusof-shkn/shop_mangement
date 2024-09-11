<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\employees;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Spatie\Permission\Models\Role;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {   
        Validator::make($input, [
            'validate' => ['required', 'string','in:7as9dbj8708aej,3na908nt7s9fdn,n9nb7xm7rie0n'],
        ])->validate();
        if($input['validate'] === '7as9dbj8708aej'){
            $role = 'admin';
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255','unique:users'],
                'email' => ['required', 'string', 'email', 'max:255'], 
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
                ])->validate();
                $user = User::create([
                    'name' => $input['name'],
                    'username' => $input['username'],
                    'role' => 1,
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                ]);
            $admin = Admin::create([
                'user_id' => $user->id,
            ]);
        };
        if($input['validate'] === '3na908nt7s9fdn'){
            $role = 'inventory_manager';
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255','unique:users'],
                'admin_username' => ['required','exists:users,username', 'string', 'max:255'],
                'phone_number' => ['required', 'string','max:255',],
                'hourly_rate' => ['required','max:255',],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
                ])->validate();
                $admin_e = User::where('username','=',$input['admin_username'])->pluck('email');
                $admin_email= $admin_e[0];
                $admin_i = User::where('username','=',$input['admin_username'])->pluck('id');
                $admin_id= Admin::where('user_id',$admin_i[0]);
                $employee = employees::create([
                    'admin_id' => $admin_id->id,
                    'name' => $input['name'],
                    'phone_number' => $input['phone_number'],
                    'hourly_rate' => $input['hourly_rate'],
                    'role' => 2,
                ]);
                $user = User::create([
                    'name' => $input['name'],
                    'username' => $input['username'],
                    'email' => $admin_email,
                    'role' => 2,
                    'admin_id' => $admin_id->id,
                    'manager_id' => $employee->id,
                    'password' => Hash::make($input['password']),
                ]);
        };
        if($input['validate'] === 'n9nb7xm7rie0n'){
            $role = 'service_manager';
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255','unique:users'],
                'admin_username' => ['required','exists:users,username', 'string', 'max:255'],
                'phone_number' => ['required', 'string','max:255',],
                'hourly_rate' => ['required','max:255',],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
                ])->validate();
                $admin_e = User::where('username','=',$input['admin_username'])->pluck('email');
                $admin_email= $admin_e[0];
                $admin_i = User::where('username','=',$input['admin_username'])->pluck('id');
                $admin_id= Admin::where('user_id',$admin_i[0]);
                $employee = employees::create([
                    'admin_id' => $admin_id->id,
                    'name' => $input['name'],
                    'phone_number' => $input['phone_number'],
                    'hourly_rate' => $input['hourly_rate'],
                    'role' => 2,
                ]);
                $user = User::create([
                    'name' => $input['name'],
                    'username' => $input['username'],
                    'email' => $admin_email,
                    'role' => 3,
                    'admin_id' => $admin_id->id,
                    'manager_id' => $employee->id,
                    'password' => Hash::make($input['password']),
                ]);
        };
        
        return $user->assignRole($role);
    }
}
