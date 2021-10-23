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
                $user = Auth::user(); 
                $ui=  Auth::user()->id;
                $subs = 'plan';
                $subscriptions = Laravel\Cashier\Subscription::where('user_id',$ui)->first();
                ?>
                
                <!-- {{$subscriptions->stripe_price}} -->

                @if($subscriptions->stripe_price == 'price_1JlIrsDBfyvrAKAqAELdn22p')
                Welcome {{$user->name}} ! You are subscribed to the Standard subscription plan.
                @elseif($subscriptions->stripe_price == 'price_1JlIrsDBfyvrAKAqiQDk4sLy')
                Welcome {{$user->name}} ! You are subscribed to the Premium subscription plan.
                @endif
                
               


                
                
                <!-- @if(Auth::user()->id == 0)
                {{$user->id}}
                
                @elseif(Auth::user()->id == 1)
                {{Auth::user()->stripe_id }}
                
                @endif -->


            </div>
        </div>
    </div>
</x-app-layout>
