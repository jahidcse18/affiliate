<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Wallet;
use Illuminate\Auth\Events\Registered;


class CreateWalletForUser
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        // Create a wallet for the newly registered user
        Wallet::create([
            'user_id' => $event->user->id,
            'balance' => 0, // Initial balance
        ]);
    }
}
