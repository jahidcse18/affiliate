<?php

// app/Http/Controllers/AffiliateController.php
namespace App\Http\Controllers;

use App\Models\AffiliateLink;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AffiliateController extends Controller {
//    public function generateReferralLink() {
////        $user = Auth::user();
////        $uniqueCode = Str::random(10);
//////        dd($uniqueCode);
////
////        // Create the affiliate link
////        $affiliateLink = AffiliateLink::create([
////            'user_id' => $user->id,
////            'unique_code' => $uniqueCode,
////        ]);
////
////        return redirect()->back()->with('success', 'Your referral link is: '.url('/?ref='.$affiliateLink->unique_code));
//        $user = Auth::user();
//
//        // Check if the user already has an affiliate link
//        $existingLink = AffiliateLink::where('user_id', $user->id)->first();
//
//        if ($existingLink) {
//            // If the affiliate link already exists, return it
//            return redirect()->back()->with('success', 'Your referral link is: '.url('/?ref='.$existingLink->unique_code));
//        }
//
//        // If the affiliate link doesn't exist, create a new one
//        $uniqueCode = Str::random(10);
//        $affiliateLink = AffiliateLink::create([
//            'user_id' => $user->id,
//            'unique_code' => $uniqueCode,
//        ]);
//
//        return redirect()->back()->with('success', 'Your referral link is: '.url('/?ref='.$affiliateLink->unique_code));
//    }
    public function generateReferralLink(Request $request)
    {
        // Only allow admins to generate links for users
        if (Auth::user()->user_type !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Only admins can generate affiliate links.');
        }

        // Validate the request (make sure user_id is provided)
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $uniqueCode = Str::random(10);

        // Create or find the existing affiliate link for the selected user
        $affiliateLink = AffiliateLink::firstOrCreate(
            ['user_id' => $user->id],
            ['unique_code' => $uniqueCode]
        );

        return redirect()->back()->with('success', 'Affiliate link created for ' . $user->name . ': ' . url('/?ref=' . $affiliateLink->unique_code));
    }
    public function showGenerateLinkForm()
    {
        // Fetch all users except admins
        $users = User::where('user_type', '!=', 'admin')->get();

        return view('generate_link', compact('users'));
    }


    public function handleAffiliateLink($unique_code)
    {
        // Store the unique code in the session
        session(['referral_code' => $unique_code]);

        // Redirect to the shop or home page
        return redirect()->route('shop'); // Adjust this as per your routing
    }

}

