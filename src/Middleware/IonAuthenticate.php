<?php

namespace PtpnId\IonAuth\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IonAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        // Jika sudah login Laravel, lanjutkan
        if (Auth::check()) {
            return $next($request);
        }

        // Jika belum login, arahkan ke SSO
        $currentUrl = $request->fullUrl();
        $ssoLoginUrl = config('ion-auth.sso_login_url') . '?redirect=' . urlencode($currentUrl);


        return redirect()->away($ssoLoginUrl);
    }
}
