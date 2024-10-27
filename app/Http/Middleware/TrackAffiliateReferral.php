<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AffiliateLink;

class TrackAffiliateReferral {
    public function handle($request, Closure $next) {
        if ($request->has('ref')) {
            $referralCode = $request->input('ref');
            $affiliateLink = AffiliateLink::where('unique_code', $referralCode)->first();

            if ($affiliateLink) {
                session(['affiliate_link_id' => $affiliateLink->id]);
                $affiliateLink->increment('clicks');
            }
        }
        return $next($request);
    }
}
