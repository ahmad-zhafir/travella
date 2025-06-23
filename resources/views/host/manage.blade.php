<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Travella - Host Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/manage.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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

  <div class="container">
    <div class="back-button-wrapper">
      <a href="{{ route('host.dashboard') }}" class="btn btn-back">← Back to Dashboard</a>
    </div>
    <section class="listing-info">
      <h1>{{ $listing->title }}</h1>
      <p>{{ $listing->location }}</p>
    </section>

    <!-- Dashboard Summary Boxes -->
    <div class="dashboard-summary">
      <div class="summary-box">
        <h3>Total Bookings</h3>
        <p>{{ $total }}</p>
      </div>
      <div class="summary-box">
        <h3>Upcoming Bookings</h3>
        <p>{{ $upcoming->count() }}</p>
      </div>
      <div class="summary-box">
        <h3>Cancelled Bookings</h3>
        <p>{{ $cancelled->count() }}</p>
      </div>
      <div class="summary-box">
        <h3>Completed Bookings</h3>
        <p>{{ $completed->count() }}</p>
      </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="tabs">
      <a href="#" class="tab active">Upcoming Bookings</a>
      <a href="#" class="tab">Cancelled Bookings</a>
      <a href="#" class="tab">Completed Bookings</a>
    </div>

<!-- Upcoming Booking Section -->
<div class="tab-content" id="upcoming-tab">
    @forelse($upcoming as $booking)
    <div class="booking-card-upcoming">
        <div class="booking-card-top">
          <p class="guest-name">{{ $booking->name }}</p>
          <span class="status upcoming">Upcoming</span>
        </div>
        <div class="booking-card-header">
          <div>
            <p class="booking-id">Booking ID: <span>{{ $booking->id }}</span></p>
            <p class="contact-no">Contact No: <span>{{ $booking->contact_no }}</span></p>
            <p class="email">Email: {{ $booking->email }}</p>
          </div>
          <div>
            <p class="checkin">Check in: {{ \Carbon\Carbon::parse($booking->startDate)->format('D, d F Y') }}</p>
            <p class="checkout">Check out: {{ \Carbon\Carbon::parse($booking->endDate)->format('D, d F Y') }}</p>
            <p class="book-date">Booked on: {{ \Carbon\Carbon::parse($booking->created_at)->format('H:i, d F Y') }}</p>
          </div>
          <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
    @csrf
    <button type="button" class="cancel-btn"  onclick="openCancelModal({{ $booking->id }})">Cancel</button>
</form>
        </div>
      </div>
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

<!-- Cancelled Booking Section -->
<div class="tab-content" id="cancelled-tab" style="display: none;">
     @forelse($cancelled as $booking)
        <div class="booking-card-cancel">
                <div class="booking-card-top">
                <p class="guest-name">{{ $booking->name }}</p>
                <span class="status cancelled">Cancelled</span>
                </div>
                <div class="booking-card-header">
                <div>
                    <p class="booking-id">Booking ID: <span>{{ $booking->id }}</span></p>
                    <p class="contact-no">Contact No: <span>{{ $booking->contact_no }}</span></p>
                    <p class="email">Email: {{ $booking->email }}</p>
                </div>
                <div>
                    <p class="checkin">Check in: {{ \Carbon\Carbon::parse($booking->startDate)->format('D, d F Y') }}</p>
                    <p class="checkout">Check out: {{ \Carbon\Carbon::parse($booking->endDate)->format('D, d F Y') }}</p>
                    <p class="cancel-date">Cancelled on: {{ \Carbon\Carbon::parse($booking->updated_at)->format('H:i, d F Y') }}</p>
                </div>
                                   <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
    @csrf
    <button type="button" class="cancel-btn hide" disabled onclick="openCancelModal({{ $booking->id }})">Cancel</button>
</form>
                </div>
            </div>
    @empty
        <p>No cancelled bookings.</p>
    @endforelse
</div>



<!-- Completed Booking Section -->
<div class="tab-content" id="completed-tab" style="display: none;">
@forelse($completed as $booking)
  <div class="booking-card-complete">
        <div class="booking-card-top">
          <p class="guest-name">{{ $booking->name }}</p>
          <span class="status completed">Completed</span>
        </div>
        <div class="booking-card-header">
          <div>
            <p class="booking-id">Booking ID: <span>{{ $booking->id }}</span></p>
            <p class="contact-no">Contact No: <span>{{ $booking->contact_no }}</span></p>
            <p class="email">Email: {{ $booking->email }}</p>
          </div>
          <div>
            <p class="checkin">Check in: {{ \Carbon\Carbon::parse($booking->startDate)->format('D, d F Y') }}</p>
            <p class="checkout">Check out: {{ \Carbon\Carbon::parse($booking->endDate)->format('D, d F Y') }}</p>
            <p class="completed-date">Completed on: {{ \Carbon\Carbon::parse($booking->updated_at)->format('H:i, d F Y') }}</p>
          </div>
                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
    @csrf
    <button type="button" class="cancel-btn hide" disabled onclick="openCancelModal({{ $booking->id }})">Cancel</button>
</form>
        </div>
      </div>
    @empty
        <p>No completed bookings.</p>
    @endforelse
</div>
     


  </div>
  <footer>
    &copy; 2025 Travella. All rights reserved.
  </footer>
</body>
<script>
  const tabs = document.querySelectorAll(".tab");
  const tabContents = {
    "Upcoming Bookings": document.getElementById("upcoming-tab"),
    "Cancelled Bookings": document.getElementById("cancelled-tab"),
    "Completed Bookings": document.getElementById("completed-tab"),
  };

  tabs.forEach(tab => {
    tab.addEventListener("click", function (e) {
      e.preventDefault();

      // Remove active class from all tabs
      tabs.forEach(t => t.classList.remove("active"));
      tab.classList.add("active");

      // Hide all tab contents
      Object.values(tabContents).forEach(content => content.style.display = "none");

      // Show selected content
      const tabName = tab.textContent.trim();
      const selectedContent = tabContents[tabName];
      selectedContent.style.display = "block";

      // Check if there are booking cards in the selected tab
      const hasCard = selectedContent.querySelector("[class*='booking-card']");
      const noBookingMsg = selectedContent.querySelector(".no-booking-msg");

      if (!hasCard && noBookingMsg) {
        noBookingMsg.style.display = "block";
      } else if (noBookingMsg) {
        noBookingMsg.style.display = "none";
      }
    });
  });

  // Trigger initial load state
  tabs[0].click();


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