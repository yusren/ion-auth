# PHP ION Auth Client
Agar Framework Laravel bisa menggunakan layanan SSO ION PTPN IV

## Instalasi 

1. Pasang package-nya 

```sh
composer require ptpnid/ion-auth
```
2. Siapkan parameter baru di file file .env

```sh
#...
ION_SSO_LOGIN_URL=login url sso ion
ION_REDIRECT_AFTER_LOGIN=kemana url client akan diarahkan setelah berhasil login
ION_APP_KEY=diberikan oleh ion sso
ION_APP_SECRET=diberikan oleh ion sso
ION_SSO_API_URL=url sso ION
#...
```

3. Pastikan parameter telah berlaku

```sh
php artisan config:cache 
```

## Bagaimana menggunakan di Route?

1. Untuk User biasa, Admin dan Guest 
```php
// Gunakan guard default (web)
Route::middleware('ion.auth')->get('/dashboard', fn () => view('dashboard'));

// Gunakan guard "admin"
Route::middleware('ion.auth:admin')->get('/admin', fn () => view('admin.dashboard'));

// Hanya bisa diakses jika BELUM login
Route::middleware('ion.auth:web,guest')->get('/welcome', fn () => view('guest.welcome'));
```