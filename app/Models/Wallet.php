<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'balance'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function transactions() {
        return $this->hasMany(WalletTransaction::class);
    }

    public function addFunds($amount) {
        $this->balance += $amount;
        $this->save();

        // Log the transaction
        WalletTransaction::create([
            'wallet_id' => $this->id,
            'amount' => $amount,
            'type' => 'deposit',
        ]);
    }

    public function deductFunds($amount) {
        if ($this->balance < $amount) {
            throw new \Exception('Insufficient funds');
        }

        $this->balance -= $amount;
        $this->save();

        // Log the transaction
        WalletTransaction::create([
            'wallet_id' => $this->id,
            'amount' => $amount,
            'type' => 'withdrawal',
        ]);
    }
}
