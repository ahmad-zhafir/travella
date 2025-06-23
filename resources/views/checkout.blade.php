<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travella - Checkout</title>
  <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
  <header>
    <nav>
      <div class="logo" tabindex="0" role="banner" aria-label="Brand logo">
        Travella
      </div>
  </header>

  
<main>
  <div class="back-button-wrapper">
    <a href="{{ url('listing/' . $listing->id) }}?checkin={{ $checkin }}&checkout={{ $checkout }}" class="btn btn-back">← Back to Listing</a>
  </div>

<div class="page-container">

    <div class="main-content">

      <div class="left-section">
        <div class="header">
          <h1>Confirm your booking</h1>
        </div>

        @php
        $nights = \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout));
        $totalPrice = $listing->price * $nights;
        @endphp

        <div class="trip-summary-wrapper">
          <div class="trip-section">
            <h2>Your trip summary</h2>

              <div class="booking-box">
                    <div class="booking-section left">
                        <div class="label">Check-in</div>
                        <div class="date">{{ \Carbon\Carbon::parse($checkin)->format('d M Y') }}</div>
                        <div class="time">02:00 PM</div>
                    </div>
                    <div class="nights">{{ $nights }} night{{ $nights > 1 ? 's' : '' }}</div>
                    <div class="booking-section right">
                        <div class="labelright">Check-out</div>
                        <div class="date">{{ \Carbon\Carbon::parse($checkout)->format('d M Y') }}</div>
                        <div class="timeright">12:00 PM</div>
                    </div>
                </div>

                
            <h2>Enter Your Details</h2>
            <label><input type="checkbox" id="selfBooking"> I'm booking this for myself</label><br>
            @if ($errors->any())
    <div class="error-summary">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form id="bookingForm" method="POST" action="{{ route('book') }}">
            @csrf
                    <div class="booking-form">
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        <input type="hidden" name="startDate" value="{{ $checkin }}">
                        <input type="hidden" name="endDate" value="{{ $checkout }}">
                        <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                        <input type="hidden" name="days" value="{{ $nights }}">
                    
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" required>

                        <label for="email">Email Address:</label>
                        <input type="email" id="email" name="email" placeholder="e.g. yourname@email.com" required>

                        <label for="contact_no">Contact Number:</label>
                        <input type="text" id="contact_no" name="contact_no" placeholder="e.g. +60123456789" required>

                    </div>
                </div>
            </form>
            

          <hr />

          <div class="summary-card">
            <img src="{{ asset($listing->photos->first()->path) }}" alt="Listing image" class="summary-image" />
            <div class="summary-text">
              <h3>{{ $listing->title }}</h3>
              <p>{{ $listing->location }}</p>
            </div>

            <hr />

            <div class="price-details">
              <span>RM{{ number_format($listing->price, 2) }} × {{ $nights }} night{{ $nights > 1 ? 's' : '' }}</span>
              <span>RM{{ number_format($totalPrice, 2) }}</span>
            </div>

            <hr />

            <div class="total-row">
              <strong>Total (MYR)</strong>
              <strong>RM{{ number_format($totalPrice, 2) }}</strong>
            </div>
            <div class="confirm-booking">
            <button type="submit" form="bookingForm" class="btn-confirm">Confirm Booking</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</main>            
          <!-- Popup Modal -->
        @if(session('successfullyBooked'))
            <div id="popupModal" class="modal">
        <div class="modal-content">
            <h2>Thank You!</h2>
            <p>Your booking has been successfully processed.</p>

            <div class="modal-buttons">
                <a href="{{ route('booking.detail', ['id' => $bookingId]) }}" class="btn-close">View Booking</a>
                <a href="{{ route('home') }}" class="btn-close">Return Home</a>
            </div>
            <p id="countdown-text"><em>Redirecting to Home in <span id="countdown">10</span> seconds...</em></p>
        </div>
    </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('popupModal').style.display = 'block';

                    // Countdown timer
                let timeLeft = 10;
                const countdownEl = document.getElementById('countdown');
                const interval = setInterval(() => {
                timeLeft--;
                countdownEl.textContent = timeLeft;
                if (timeLeft <= 0) {
                    clearInterval(interval);
                    window.location.href = "{{ route('home') }}";
                }
            }, 1000);
                });
            </script>
        @endif
  <footer>
    &copy; 2025 Travella. All rights reserved.
  </footer>
</body>
<script>
document.getElementById('selfBooking').addEventListener('change', function () {
    if (this.checked) {
        fetch('/user-info')
            .then(response => response.json())
            .then(data => {
                document.getElementById('name').value = data.name;
                document.getElementById('email').value = data.email;
                document.getElementById('contact_no').value = data.contact_no;
            });
    } else {
        // Optional: Clear fields when unchecked
        document.getElementById('name').value = '';
        document.getElementById('email').value = '';
        document.getElementById('contact_no').value = '';
    }
});

document.getElementById('bookingForm').addEventListener('submit', function(event) {
  const form = this;

  if (!form.checkValidity()) {
    event.preventDefault(); // Stop form from submitting
    form.reportValidity();  // Trigger browser's built-in validation UI
  }
});
</script>
</html>