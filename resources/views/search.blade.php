<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Travella | Search Results</title>
  <link rel="stylesheet" href="{{ asset('css/search.css') }}" />
</head>
<body>
  <nav>
    <div class="nav-left" onclick="window.location='{{ url('/') }}'">Travella</div>
    <div class="nav-center">
      <a href="{{ route('home') }}" tabindex="0">Home</a>
      <a href="{{ route('bookings.guest') }}" tabindex="0">Manage Booking</a>
      <a href="{{ route('contact.page') }}" tabindex="0">Contact Us</a>
    </div>
    <div class="nav-right">
      @if(Auth::check()) <!-- Check if the user is logged in -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline-block;">
          @csrf
          <button class="nav-button" type="submit">Logout</button>
        </form>
      @else
@php
  $query = http_build_query([
    'location' => request('location'),
    'checkin' => request('checkin'),
    'checkout' => request('checkout')
  ]);
  $fullSearchUrl = url('/search') . '?' . $query;
@endphp

<button class="nav-button" type="button" onclick="window.location.href='{{ route('login') }}?redirect={{ urlencode($fullSearchUrl) }}'">Log in</button>
        <button class="nav-button" type="button" onclick="window.location.href='{{ route('register') }}?redirect={{ urlencode($fullSearchUrl) }}'">Sign up</button>
      @endif
    </div>
  </nav>

  <main>
    <h1 class="page-title">Search Results</h1>
    <p class="search-summary">
      Showing results for <strong>{{ $location ?? 'Anywhere' }}</strong>
      @if ($checkin && $checkout)
        from <strong>{{ \Carbon\Carbon::parse($checkin)->format('d M Y') }}</strong> to <strong>{{ \Carbon\Carbon::parse($checkout)->format('d M Y') }}</strong>
      @endif
    </p>

    <div class="listings-grid">
      @forelse ($listings as $listing)
        <div class="listing-card" onclick="window.location.href='{{ url('/listing/' . $listing->id) }}?location={{ urlencode($location) }}&checkin={{ urlencode($checkin) }}&checkout={{ urlencode($checkout) }}'">

          <img 
            src="{{ asset(($listing->photos->first()->path ?? 'placeholder.jpg')) }}" 
            alt="{{ $listing->title }}" 
            class="listing-img"
          />
          <div class="listing-info">
            <h3 class="listing-title">{{ $listing->title }}</h3>
            <p class="listing-location">{{ $listing->location }}</p>
            <p class="listing-details">
              {{ $listing->bedrooms }} {{ $listing->bedrooms == 1 ? 'Bedroom' : 'Bedrooms' }},
              {{ $listing->bathrooms }} {{ $listing->bathrooms == 1 ? 'Bathroom' : 'Bathrooms' }}
            </p>
            <p class="listing-price">RM{{ $listing->price }} <small>per night</small></p>
          </div>
        </div>
      @empty
        <p class="no-results">No listings match your search criteria.</p>
      @endforelse
    </div>
  </main>

  <footer>&copy; 2025 Travella. All rights reserved.</footer>
</body>
</html>
