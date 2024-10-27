<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\AffiliateCommission;
use App\Models\AffiliateLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {
    public function placeOrder(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->input('product_id'));
        $totalPrice = $product->price * $request->quantity;

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'amount' => $totalPrice,
            'quantity' => $request->quantity,
            'status' => 'pending',
        ]);

        // Check for affiliate link in session
        $affiliateLinkId = session('affiliate_link_id', null);
        if (session()->has('referral_code')) {
            // Find the affiliate link based on the unique code
            $affiliateLink = AffiliateLink::where('unique_code', session('referral_code'))->first();


//            if ($affiliateLinkId) {
//            $affiliateLink = AffiliateLink::find($affiliateLinkId);

            if ($affiliateLink) {
//                $commissionAmount = ($product->price * $product->commission_rate) / 100;
                $commissionAmount = ($totalPrice * $product->commission_rate) / 100;

                AffiliateCommission::create([
                    'affiliate_link_id' => $affiliateLink->id,
                    'order_id' => $order->id,
                    'commission_amount' => $commissionAmount,
                    'status' => 'pending',
                ]);

                // Add commission to affiliate's wallet
                $affiliate = $affiliateLink->user;
//                dd($affiliate->wallet);
                $affiliate->wallet->addFunds($commissionAmount);

                // Clear affiliate link from session
                session()->forget('referral_code');
//                session()->forget('affiliate_link_id');
            }
        }

//        return redirect()->back()->with('success', 'Order placed successfully!');
        return redirect()->route('shop')->with('success', 'Order placed successfully!');
    }
    // App\Http\Controllers\OrderController.php
    public function showShop()
    {
        $products = Product::all(); // Fetch all products
        return view('shop', compact('products'));
    }

}

