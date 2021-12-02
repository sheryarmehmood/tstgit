<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <?php 
                 $user =  Auth::user();
                 $team = $user->currentTeam;
                ?>    
    @if($user->ownsTeam($team))
    <div class="py-12" >
    <h1 class="font-semibold text-xl py-3" style="text-align: center">Upload Agreement</h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <x-jet-welcome /> -->
                           
                    
                    
                    <div style="padding:10px;">
                    
                    <form action="upload" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="agreement"> <br><br>
                    <button type="submit" style="background:#6875F5;color:white;padding:5px;">Upload</button>
                    
                    </form>
                    
                    </div>

                    </div>
        </div>
        
    </div>
    @endif
</x-app-layout>