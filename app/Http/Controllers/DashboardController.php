<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AffiliateLink;
use Illuminate\Support\Facades\Auth;
use App\Models\AffiliateCommission;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch the affiliate link for the logged-in user
        $affiliateLink = AffiliateLink::where('user_id', $user->id)->first();

        $commissions = AffiliateCommission::whereHas('affiliateLink', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('dashboard', compact('affiliateLink','commissions'));
    }
}
