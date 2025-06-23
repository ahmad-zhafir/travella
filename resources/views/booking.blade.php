<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Travella - Stay Anywhere</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

  <div class="page-wrapper">
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
        <button class="nav-button" type="button" onclick="window.location.href='{{ route('login') }}'">Log in</button>
        <button class="nav-button" type="button" onclick="window.location.href='{{ route('register') }}'">Sign up</button>
      @endif
    </div>
    </nav>
    <header>
        <h1>Your Booking</h1>
        <p>Book unique places to stay around the world</p>
    </header>
<main>
    <div class="status">
        <a href="#" class="tab-link active">Upcoming</a>
        <a href="#" class="tab-link">Completed</a>
        <a href="#" class="tab-link">Cancelled</a>
    </div>

{{-- Booked Tab --}}
<div id="upcoming" class="tab-content">
    @forelse($guestBookings['booked'] ?? [] as $booking)
        @php
            $listing = $booking->listing;
            $photo = $listing->photos->first();
        @endphp
        <article class="listing-card">
            <img src="{{ asset(($photo->path ?? 'placeholder.jpg')) }}" alt="Image of {{ $listing->title }}" class="listing-img" />
            <div class="listing-info">
                <h3 class="listing-title">{{ $listing->title }}</h3>
                <p class="listing-location">{{ $listing->location }}</p>
                <p class="listing-booking">Booking ID: {{ $booking->id }}</p>
                <p class="listing-checkin">Check In: {{ \Carbon\Carbon::parse($booking->startDate)->format('D, d F Y') }}</p>
                <p class="listing-checkout">Check Out: {{ \Carbon\Carbon::parse($booking->endDate)->format('D, d F Y') }}</p>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                    <p class="listing-upcoming" style="display: flex; align-items: center; margin: 0; color: #0096FF; ">
                        <i class="fa fa-calendar-check-o" style="font-size: 24px; color: #0096FF; margin-right: 8px;"></i>
                        <b>Upcoming</b>
                    </p>
                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
                        @csrf
                        <button type="button" class="cancel-button" style="text-decoration: none; color: white;"  onclick="openCancelModal({{ $booking->id }})">Cancel Booking</button>
                    </form>
                    <a href="{{ route('booking.detail', $booking->id) }}" class="view-button" style="text-decoration: none; color: white;" role="button" aria-label="View Booking Details">View Details</a>
                </div>
            </div>
        </article>
    @empty
        <p>No upcoming bookings.</p>
    @endforelse
</div>

<!-- Cancel Confirmation Modal -->
<div id="cancelConfirmModal" class="modal" style="display:none;">
    <div class="modal-content">
        <h2>Cancel Booking?</h2>
        <p>This action cannot be undone. Do you wish to continue?</p>

        <form id="cancelForm" method="POST">
            @csrf
            <div class="modal-buttons">
                <button type="submit" class="btn-close">Yes, Cancel</button>
                <button type="button" class="btn-close" onclick="closeCancelModal()">No, Go Back</button>
            </div>
        </form>
    </div>
</div>

@if(session('cancelSuccess'))
<div id="cancelSuccessModal" class="modal">
    <div class="modal-content">
        <h2>Booking Cancelled</h2>
        <p>Your booking has been successfully cancelled.</p>
        <div class="modal-buttons">
                <button type="button" class="btn-close" onclick="closeCancelSuccessModal()">Close</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('cancelSuccessModal').style.display = 'block';
    });
</script>
@endif

{{-- Completed Tab --}}
<div id="completed" class="tab-content" style="display: none;">
    @forelse($guestBookings['completed'] ?? [] as $booking)
        @php
            $listing = $booking->listing;
            $photo = $listing->photos->first();
        @endphp
        <article class="listing-card">
            <img src="{{ asset(($photo->path ?? 'placeholder.jpg')) }}" alt="Image of {{ $listing->title }}" class="listing-img" />
            <div class="listing-info">
                <h3 class="listing-title">{{ $listing->title }}</h3>
                <p class="listing-location">{{ $listing->location }}</p>
                <p class="listing-booking">Booking ID: {{ $booking->id }}</p>
                <p class="listing-checkin">Check In: {{ \Carbon\Carbon::parse($booking->startDate)->format('D, d F Y') }}</p>
                <p class="listing-checkout">Check Out: {{ \Carbon\Carbon::parse($booking->endDate)->format('D, d F Y') }}</p>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                    <p class="listing-completed" style="display: flex; align-items: center; margin: 0;color: green;">
                        <i class="fa fa-check-circle" style="font-size: 24px; color: green; margin-right: 8px;"></i>
                        <b>Completed</b>
                    </p>
                    <a href="{{ route('booking.detail', $booking->id) }}" class="view-button" style="text-decoration: none; color: white;" role="button" aria-label="View Booking Details">View Details</a>
                </div>
            </div>
        </article>
    @empty
        <p>No completed bookings.</p>
    @endforelse
</div>

{{-- Cancelled Tab --}}
<div id="cancelled" class="tab-content" style="display: none;">
    @forelse($guestBookings['cancelled'] ?? [] as $booking)
        @php
            $listing = $booking->listing;
            $photo = $listing->photos->first();
        @endphp
        <article class="listing-card">
            <img src="{{ asset(($photo->path ?? 'placeholder.jpg')) }}" alt="Image of {{ $listing->title }}" class="listing-img" />
            <div class="listing-info">
                <h3 class="listing-title">{{ $listing->title }}</h3>
                <p class="listing-location">{{ $listing->location }}</p>
                <p class="listing-booking">Booking ID: {{ $booking->id }}</p>
                <p class="listing-checkin">Check In: {{ \Carbon\Carbon::parse($booking->startDate)->format('D, d F Y') }}</p>
                <p class="listing-checkout">Check Out: {{ \Carbon\Carbon::parse($booking->endDate)->format('D, d F Y') }}</p>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                    <p class="listing-cancelled" style="display: flex; align-items: center; margin: 0;color: red;">
                        <i class="fa fa-close" style="font-size: 24px; color: red; margin-right: 8px;"></i>
                        <b>Cancelled</b>
                    </p>
                    <a href="{{ route('booking.detail', $booking->id) }}" class="view-button" style="text-decoration: none; color: white;" role="button" aria-label="View Booking Details">View Details</a>
                </div>
            </div>
        </article>
    @empty
        <p>No cancelled bookings.</p>
    @endforelse
</div>

</main>
  </div>



    <footer>
        &copy; 2025 Travella. All rights reserved.
    </footer>
</body>
<script>
   document.querySelectorAll('.tab-link').forEach((tab, index) => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();

            // Remove 'active' class from all tabs
            document.querySelectorAll('.tab-link').forEach(t => t.classList.remove('active'));
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(c => c.style.display = 'none');

            // Add 'active' to clicked tab
            tab.classList.add('active');
            // Show corresponding tab content
            const tabContents = document.querySelectorAll('.tab-content');
            if (tabContents[index]) {
                tabContents[index].style.display = 'block';
            }
        });
    });

      const tabs = document.querySelectorAll('.tab-link');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

        function openCancelModal(bookingId) {
        const form = document.getElementById('cancelForm');
        form.action = `/booking/${bookingId}/cancel`;
        document.getElementById('cancelConfirmModal').style.display = 'block';
    }

    function closeCancelModal() {
        document.getElementById('cancelConfirmModal').style.display = 'none';
    }

        function closeCancelSuccessModal() {
        document.getElementById('cancelSuccessModal').style.display = 'none';
    }
</script>

</html>