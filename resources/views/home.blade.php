<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Travella | Home Page</title>
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <nav>
    <div class="nav-left" onclick="window.location='{{ url('/') }}'">Travella</div>
    <div class="nav-center" role="navigation" aria-label="Primary navigation">
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
        <button class="nav-button" type="button" onclick="window.location.href='{{ route('login') }}?redirect=home'">Log in</button>
        <button class="nav-button" type="button" onclick="window.location.href='{{ route('register') }}?redirect=home'">Sign up</button>
      @endif
    </div>
  </nav>

<header style="position: relative;">
  <div style="position: absolute; top: 16px; right: 16px; color: white; font-size: 18px; z-index:1">
    <span id="date"></span> <span id="clock"></span>
  </div>
    
    <h1>Find your next stay</h1>
    <p>Book unique places to stay in Malaysia</p>

    @if(session('success'))
      <div class="success-message">{{ session('success') }}</div>
    @endif

    <form class="search-bar" method="POST" action="{{ route('search') }}" role="search" aria-label="Search listings">
      @csrf
      <div>
        <label for="location">Location</label>
        <select id="location" name="location" required>
          <option value="">Select a state</option>
          <option value="Johor">Johor</option>
          <option value="Kedah">Kedah</option>
          <option value="Kelantan">Kelantan</option>
          <option value="Malacca">Malacca</option>
          <option value="Negeri Sembilan">Negeri Sembilan</option>
          <option value="Pahang">Pahang</option>
          <option value="Penang">Penang</option>
          <option value="Perak">Perak</option>
          <option value="Perlis">Perlis</option>
          <option value="Sabah">Sabah</option>
          <option value="Sarawak">Sarawak</option>
          <option value="Selangor">Selangor</option>
          <option value="Terengganu">Terengganu</option>
          <option value="Kuala Lumpur">Kuala Lumpur</option>
          <option value="Labuan">Labuan</option>
          <option value="Putrajaya">Putrajaya</option>
        </select>
      </div>
      <div>
        <label for="checkin">Check-in</label>
        <input id="checkin" name="checkin" type="date" required />
      </div>
      <div>
        <label for="checkout">Check-out</label>
        <input id="checkout" name="checkout" type="date" required />
      </div>
      <div>
        <button type="submit" class="search-button">Search</button>
      </div>
    </form>
  </header>

  <main>
    <h2 class="section-title">Popular Stays</h2>
    <div class="listings-grid">
    @forelse($listings as $listing)
      <div class="listing-card" onclick="openDateModal({{ $listing->id }})">
        @if ($listing->firstPhoto)
          <img src="{{ asset($listing->firstPhoto->path) }}" alt="{{ $listing->title }}" class="listing-img">
        @else
          <img src="{{ asset('images/default-placeholder.jpg') }}" alt="No Image" class="listing-img">
        @endif
        <div class="listing-info">
          <h3>{{ $listing->title }}</h3>
          <p>{{ $listing->location }}</p>
          <p class="listing-details">
                  {{ $listing->bedrooms }} {{ $listing->bedrooms == 1 ? 'Bedroom' : 'Bedrooms' }},
                  {{ $listing->bathrooms }} {{ $listing->bathrooms == 1 ? 'Bathroom' : 'Bathrooms' }}
          </p>
          <p class="listing-price">RM{{ $listing->price }} <small>per night</small></p>
        </div>
      </div>
    @empty
      <p>No listings available at the moment.</p>
    @endforelse
  </div>

<!-- Modal for selecting dates -->
<div id="dateModal">
  <div class="modal-content">
    <button class="close-btn" onclick="closeModal()">×</button>
    <h2>Select Your Stay Dates</h2>
    <form id="dateForm">
      <input type="hidden" id="modalListingId" name="listing_id">

      <label for="modalCheckin">Check-in</label>
      <input type="date" id="modalCheckin" name="checkin" required>

      <label for="modalCheckout">Check-out</label>
      <input type="date" id="modalCheckout" name="checkout" required>

      <!-- 🔴 Error message area -->
      <p id="dateModalError" style="color: red; display: none; margin-top: 10px;"></p>

      <div class="modal-buttons">
        <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
        <button type="submit" class="submit-btn">Continue</button>
      </div>
    </form>
  </div>
</div>



        
  </main>
  <footer>
    &copy; 2025 Travella. All rights reserved.
  </footer>

    

  <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
