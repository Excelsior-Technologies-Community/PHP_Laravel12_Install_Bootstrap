PHP_Laravel12_Install_Bootstrap — Install Bootstrap in Laravel12

---
Goal:

 Add Bootstrap (v5) to a Laravel 12 project named PHP_Laravel12_Install_Bootstrap using Vite (default build system). This guide gives all commands, file contents and example Blade views so you can run and test Bootstrap locally.


Prerequisites :
---
PHP (>= 8.1) installed

Composer installed

Node.js (>= 16) and npm/yarn installed



step 1: Create the Laravel project
```
composer create-project laravel/laravel PHP_Laravel12_Install_Bootstrap "12.*"
cd PHP_Laravel12_Install_Bootstrap

```
 Explanation:

composer create-project laravel/laravel PHP_Laravel12_Install_Bootstrap → Creates a new Laravel 12 project.

cd PHP_Laravel12_Install_Bootstrap → Goes into your project folder.


Step 2: Install Laravel UI Package
```
composer require laravel/ui

```
 Explanation:

Laravel UI is a package that adds frontend scaffolding like Bootstrap, Vue, or React.

We will use it to install Bootstrap CSS/JS easily.


Step 3: Generate Bootstrap Scaffolding
```
php artisan ui bootstrap --auth
```

Explanation:

php artisan ui bootstrap → Installs Bootstrap CSS and JS in your project.

--auth → Generates pre-built authentication pages (login/register/forgot password).

You should see this output:
```
Bootstrap scaffolding installed successfully.
Please run "npm install && npm run dev" to compile your assets.
```
Step 4: Install Node.js Dependencies
```
npm install

```
Explanation:

npm install downloads all frontend dependencies like Bootstrap, Popper.js, etc.

They are installed inside the node_modules folder.


Step 5: Compile Assets

After installing npm packages, compile CSS/JS:

For development (fast):
```
npm run dev
```
For production (optimized):
```
npm run build
```

 Explanation:

Laravel 12 uses Vite to compile frontend assets.

npm run dev → Compiles for development.

npm run production → Compiles for production (minified & optimized).

After this, compiled CSS is in public/css/app.css and JS in public/js/app.js.


Step 6: Add Bootstrap to Blade Template

Open resources/views/welcome.blade.php and replace with:
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Bootstrap 12</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="#">Laravel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="bg-light text-center py-5">
  <div class="container">
    <h1 class="display-4 text-primary fw-bold">Bootstrap Installed in Laravel 12!</h1>
    <p class="lead mb-4">Your project is fully styled with Bootstrap 5.</p>
    
  </div>
</section>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```


Step 7: Optional – Add Navbar Layout

Create a layout file resources/views/layouts/app.blade.php:
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel App') }}</title>

    {{-- Load compiled CSS & JS via Vite --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel App') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main content --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>
```

Explanation:

Layout separates common navbar and scripts.

@yield('content') → Page-specific content goes here.

This is the proper Laravel way to structure views.


Step 8: Auth Pages (Optional)

If you ran --auth:
```
/login → Login page

/register → Register page

/home → Dashboard after login
```

auth/login.blade.php (replace with this code)
```
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header text-center">{{ __('Login') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control" name="email" required autofocus>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

```
auth/register.blade.php (replace with this code)
```
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header text-center">{{ __('Register') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control" name="email" required>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
```

sass/app.scss (replace with this code)
```
// Use statements must be at the top
@use 'variables';
@use 'bootstrap';

// Fonts (after @use)
@import url('https://fonts.bunny.net/css?family=Nunito');

// Your custom CSS
body {
    font-family: 'Nunito', sans-serif;
}

```
Step 9: Routes (routes/web.php)
```
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
```

Step 10: Run Laravel Server
```
php artisan serve
```
Visit:
```
http://127.0.0.1:8000
```


You will see:


Home page → welcome.blade.php

<img width="1916" height="969" alt="Screenshot 2025-12-11 181816" src="https://github.com/user-attachments/assets/2f0c0ca7-0e62-41ad-a92a-7e5044f3e20d" />


Login/Register pages → /register

<img width="1910" height="970" alt="Screenshot 2025-12-11 181838" src="https://github.com/user-attachments/assets/1f4cac88-7750-4a01-bea2-61c09bd5b6f1" />

Login/Register pages → /login

<img width="1910" height="965" alt="Screenshot 2025-12-11 181828" src="https://github.com/user-attachments/assets/b3e95c90-04ef-4229-baf3-e3d8cf2179bb" />






All fully styled with Bootstrap 5.


Step 11: Full Command Summary

```
# 1. Create project
composer create-project laravel/laravel PHP_Laravel12_Install_Bootstrap
cd PHP_Laravel12_Install_Bootstrap

# 2. Install Laravel UI
composer require laravel/ui

# 3. Install Bootstrap scaffolding

php artisan ui bootstrap --auth

# 4. Install npm packages
npm install

# 5. Compile assets
npm run dev
# or production
npm run build

# 6. Run server
php artisan serve
```
