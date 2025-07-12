<?php
return [
    'sso_login_url' => env('ION_SSO_LOGIN_URL', 'https://sso.ptpn.id/login'),
    'redirect_after_login' => env('ION_REDIRECT_AFTER_LOGIN', '/dashboard'),
    'app_key' => env('ION_APP_KEY'),
    'app_secret' => env('ION_APP_SECRET'),
    'sso_api_url' => env('ION_SSO_API_URL', 'https://sso-saya.com/api/client/init'),
];