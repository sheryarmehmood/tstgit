<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Models\Team;
use Laravel\Jetstream\HasTeams;
use Carbon\Carbon;


class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        $user = auth()->user();
        // $team = $user->currentTeam->id;
        // // print_r($team);
        // $team = Team::find($team);
        
        if($user->trial_ends_at != null && $user->trial_ends_at < Carbon::now())
        {
            if($user->pm_last_four == null)
            {
                return view('dashboard');
            }
            else
            {
            return view('dashboard');
            }    


        }
        else
        {
            return view('dashboard');
        }

        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade
        // return $request->wantsJson()
        // ? response()->json(['two_factor' => false])
        // : redirect()->intended(config('fortify.home'));

        // if ($user->hasTeamPermission($team , 'create')) 
        // {
        //     return view('author-dash');
        // }
        //     else if ($user->hasTeamPermission($team , 'update'))
        //     {
        //     return view('editor-dash');
        //     }
    
    }

}
