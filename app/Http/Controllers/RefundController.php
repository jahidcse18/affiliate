<?php

// app/Http/Controllers/RefundController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\AffiliateCommission;
use Illuminate\Http\Request;

class RefundController extends Controller {
    public function processRefund($orderId) {
        $order = Order::findOrFail($orderId);
        $commission = AffiliateCommission::where('order_id', $order->id)->first();

        if ($commission && $commission->status == 'approved') {
            $commission->status = 'refunded';
            $commission->save();

            $affiliate = $commission->affiliateLink->user;
            $affiliate->wallet->deductFunds($commission->commission_amount);
        }

        // Handle the refund logic for the order
        // ...
    }
}
