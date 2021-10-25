<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <x-jet-welcome /> -->
                <?php 
                 $user =  Auth::user();
                 $team = $user->currentTeam;
                ?>
                
                

                <!-- @if($user->hasTeamRole($team, 'writer')) -->
                <!-- {{$user->allTeams()}} -->
                <!-- @endif -->
                <!-- @if(Auth::user()->id == 0)
                {{$user->id}}
                
                @elseif(Auth::user()->id == 1)
                {{Auth::user()->stripe_id }}
                
                @endif -->


            </div>
        </div>
    </div>
</x-app-layout>
