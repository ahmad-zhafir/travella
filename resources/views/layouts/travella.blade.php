<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Travella')</title>
    <link rel="stylesheet" href="{{ asset('css/addlisting.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>

<body>
<nav>
        <div class="nav-left" tabindex="0" role="banner" aria-label="Brand logo">Travella</div>
    <div class="nav-center" role="navigation" aria-label="Primary navigation">
      <span class="nav-title">Host Dashboard</span>
    </div>
    <div class="nav-right">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="nav-button" type="submit">Log Out</button>
      </form>
    </div>
    </nav>

    <main>
        <div class="back-button-wrapper">
            <a href="{{ route('host.dashboard') }}" class="btn btn-back">← Back to Dashboard</a>
        </div>

        <div class="container">
            <h1>@yield('page-title', 'Page Title')</h1>

            {{-- Main content injected here --}}
            @yield('content')
        </div>
    </main>

    <footer>
        &copy; 2025 Travella. All rights reserved.
    </footer>
</body>

</html>
