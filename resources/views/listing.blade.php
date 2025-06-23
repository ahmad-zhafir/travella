<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Travella | Listing Details</title>
    <link rel="stylesheet" href="{{ asset('css/listing.css') }}" />
    <!-- Font Awesome Free (v6 latest) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

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
    'id' => $listing->id,
    'location' => request('location'),
    'checkin' => request('checkin'),
    'checkout' => request('checkout')
  ]);
  $fullSearchUrl = url('/listing/'. $listing->id) . '?' . $query;
@endphp

<button class="nav-button" type="button" onclick="window.location.href='{{ route('login') }}?redirect={{ urlencode($fullSearchUrl) }}'">Log in</button>
        <button class="nav-button" type="button" onclick="window.location.href='{{ route('register') }}?redirect={{ urlencode($fullSearchUrl) }}'">Sign up</button>
      @endif
    </div>
  </nav>

    <section class="listing-detail">
@if(request('location') && request('checkin') && request('checkout'))
    <a href="{{ route('search', [
        'location' => request('location'),
        'checkin' => request('checkin'),
        'checkout' => request('checkout')
    ]) }}" class="btn btn-back">← Back to Search</a>
@else
    <a href="{{ url('/') }}" class="btn btn-back">← Back to Home</a>
@endif





        <div class="detail-card">
  <!-- Carousel instead of single image -->
  <div class="carousel-container">
  <div class="carousel-slides">
    @foreach($listing->photos as $photo)
      <img src="{{ asset($photo->path) }}" alt="Listing Photo" class="carousel-image" />
    @endforeach
  </div>
  <button class="carousel-btn prev" aria-label="Previous">&#10094;</button>
  <button class="carousel-btn next" aria-label="Next">&#10095;</button>
</div>

            <div class="detail-info">
                <h1>{{ $listing->title }}</h1>
                <p>{{ $listing->description }}</p>
                <h3>Location: </h3>
                    <p class="detail-location">{{ $listing->location }}</p>
                <div>
                  <h3>Amenities:</h3>
                  <ul class="listing-amenities">
                      <li><i class="fas fa-bed fa-fw"></i> {{ $listing->bedrooms }} Bedroom</li>
                      <li><i class="fas fa-bath fa-fw"></i> {{ $listing->bathrooms }} Bathroom</li>
                      @foreach($listing->amenities as $amenity)
                          <li><i class="{{ $amenity->icon }} fa-fw"></i> {{ $amenity->name }}</li>
                      @endforeach
                  </ul>
                </div>
                <p class="detail-price">RM{{ $listing->price }} <small>per night</small></p>

                <a href="{{ route('checkout', [
    'listing_id' => $listing->id,
    'checkin' => request('checkin'),
    'checkout' => request('checkout')
]) }}" class="btn btn-book">Book Now</a>

            </div>
        </div>
    </section>

    <footer>
        &copy; 2025 Travella. All rights reserved.
    </footer>
</body>
<script>
  (() => {
    const container = document.querySelector('.carousel-container');
    const slides = container.querySelector('.carousel-slides');
    const imagesCount = slides.children.length;
    let currentIndex = 0;

    const prevBtn = container.querySelector('.carousel-btn.prev');
    const nextBtn = container.querySelector('.carousel-btn.next');

    function updateCarousel() {
      slides.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    prevBtn.addEventListener('click', () => {
      currentIndex = (currentIndex === 0) ? imagesCount - 1 : currentIndex - 1;
      updateCarousel();
    });

    nextBtn.addEventListener('click', () => {
      currentIndex = (currentIndex === imagesCount - 1) ? 0 : currentIndex + 1;
      updateCarousel();
    });
  })();
</script>
</html>