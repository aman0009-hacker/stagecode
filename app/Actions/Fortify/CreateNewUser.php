<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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


        //dd("jkkjklj");
        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         Rule::unique(User::class),
        //     ],
        //     'password' => $this->passwordRules(),
        // ])->validate();

        // return User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'password' => Hash::make($input['password']),
        // ]);

        $data = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'contact_number' =>[ 'required',"numeric",'digits:10',Rule::unique(User::class)],
            // 'password' => $this->passwordRules(),
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:6',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],

        ])->validate();


        //$otp = 1234;
        
        $user= User::create([
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'contact_number' => $input['contact_number'],
            'password' => Hash::make($input['password']),
            'state'=>1
            //'otp' => $otp,
            //'otp_generated_at' => Carbon::now(),
        ]);


        // event(new Registered($user));

        // flash('Registration successful! Awaiting approval from admin.')
        //     ->success()
        //     ->important();

        return $user;
    }
}
