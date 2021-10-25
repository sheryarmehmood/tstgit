<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Carbon\Carbon;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

    
        return DB::transaction(function () use ($input) {
            if($input['stripe_id'] == 'price_1JlIrsDBfyvrAKAqAELdn22p')
            $trial_days = now()->addDays(1);
            else
            $trial_days = null;
                return tap(User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                    'trial_ends_at' => $trial_days,      
                ]), function (User $user) {
                    if($user->trial_ends_at != null){
                    $trialDays = 1;
                    $planId = "price_1JlIrsDBfyvrAKAqAELdn22p";
                    $user->createAsStripeCustomer();
                    $user->newSubscription('cashier', $planId)->create(null, [
                        'email' => $user->email
                    ], ['trial_period_days' => $trialDays]);}
                    $this->createTeam($user);
                });
            });     
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
