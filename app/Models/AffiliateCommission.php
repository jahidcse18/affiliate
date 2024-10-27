<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateCommission extends Model
{
    use HasFactory;
    protected $fillable = ['affiliate_link_id', 'order_id', 'commission_amount', 'status'];
    public function affiliateLink() {
        return $this->belongsTo(AffiliateLink::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
