<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Wallet;
use Illuminate\Auth\Events\Authenticated;
class CreateWalletOnLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        // Check if the user already has a wallet
        if (!$event->user->wallet) {
            // Create a wallet for the user
            Wallet::create([
                'user_id' => $event->user->id,
                'balance' => 0, // Initial balance
            ]);
        }
    }
}
