<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateLink extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'unique_code', 'clicks'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function commissions() {
        return $this->hasMany(AffiliateCommission::class);
    }
}
