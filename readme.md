# PHP ION Auth Client
## Bagaimana menggunakan di Route?

1. Untuk User biasa dan Admin 
```php
// Gunakan guard default (web)
Route::middleware('ion.auth')->get('/dashboard', fn () => view('dashboard'));

// Gunakan guard "admin"
Route::middleware('ion.auth:admin')->get('/admin', fn () => view('admin.dashboard'));
```

2. Untuk Route Non Auth (Guest)

```php
// Hanya bisa diakses jika BELUM login
Route::middleware('ion.auth:web,guest')->get('/welcome', fn () => view('guest.welcome'));
```