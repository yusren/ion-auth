<?php
namespace PtpnId\IonAuth\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InitController extends Controller
{
    public function handle(Request $request)
    {
        $token = $request->query('exchange-token');
        if (!$token) {
            return abort(400, 'Missing exchange token');
        }

        $response = Http::withHeaders([
            'App-Key' => config('ion-auth.app_key'),
            'App-Secret' => config('ion-auth.app_secret'),
        ])->post(config('ion-auth.sso_api_url'), [
            'token' => $token
        ]);

        if ($response->failed()) {
            return abort(403, 'Token exchange failed');
        }

        $userData = $response->json();

        $user = User::firstOrCreate(
            ['email' => $userData['email']],
            ['name' => $userData['name']]
        );

        Auth::login($user);

        return redirect()->intended(config('ion-auth.redirect_after_login'));
    }
}
