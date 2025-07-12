<?php

namespace Ptpn\IonAuth\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SsoAuthService
{
    public function checkUserToken(string $userToken): array|null
    {
        $cfg = config('ion-auth');

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept-Language' => 'en_US',
                'App-Key' => $cfg['app_key'],
                'App-Secret' => $cfg['app_secret'],
                'User-Token' => $userToken,
                'Cookie' => '060EAAA73B2BF685B99D02034D9C6386',
            ])->withCookies([
                '__Host-BSID' => session()->getId(),
            ], parse_url($cfg['sso_api_url'], PHP_URL_HOST))
              ->get($cfg['sso_api_url']);

            if ($response->failed()) {
                return null;
            }

            $data = $response->json();

            // Contoh struktur JSON:
            // { "data": { "auth_user_info": { ... } } }

            return $data['data']['auth_user_info'] ?? null;

        } catch (\Exception $e) {
            Log::error("SSO check failed: " . $e->getMessage());
            return null;
        }
    }
}
