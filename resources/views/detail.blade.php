<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Travella - Stay Anywhere</title>
    <!-- Font Awesome Free (v6 latest) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
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
        <button class="nav-button" type="button" onclick="window.location.href='{{ route('login') }}'">Log in</button>
        <button class="nav-button" type="button" onclick="window.location.href='{{ route('register') }}'">Sign up</button>
      @endif
    </div>
    </nav>

    <div class="container">

        <div class="header" style="display: flex; align-items: center; justify-content: space-between;">
    <div style="display: flex; align-items: center; gap: 10px;">
        <a href="{{ url()->previous() }}"><i class="fa fa-chevron-left"></i></a>
        <div class="title">{{ $booking->listing->title }}</div>
    </div>
    <button class="nav-button" type="button" onclick="openPrintWindow({{ $booking->id }})">
        <i class="fa fa-print" style="margin-right: 6px;"></i> Print
    </button>
</div>
        <div class="location">{{$booking->listing->location }}</div>
        
        


        <div class="list-container">
            <div class="image">
                <img src="{{ asset(($booking->listing->photos->first()->path ?? 'placeholder.jpg')) }}" alt="{{ $booking->listing->title }}" />
            </div>
            <div class="list-details">
                <p><strong>Booking ID:</strong> {{$booking->id }}</p>
                <p><strong>Dates of Stay:</strong></p>
                <div class="booking-box">
                    <div class="booking-section left">
                        <div class="label">Check-in</div>
                        <div class="date">{{ \Carbon\Carbon::parse($booking->startDate)->format('D, d F Y') }}</div>
                        <div class="time">02:00 PM</div>
                    </div>
                    <div class="nights">{{$booking->days }} night</div>
                    <div class="booking-section right">
                        <div class="labelright">Check-out</div>
                        <div class="date">{{ \Carbon\Carbon::parse($booking->endDate)->format('D, d F Y') }}</div>
                        <div class="timeright">12:00 PM</div>
                    </div>
                </div>

                @if($booking->status === 'booked')
                    <p class="upcoming">Thanks for booking. We look forward to hosting you!</p>
                @elseif($booking->status === 'cancelled')
                    <p class="cancelled">Reservation cancelled. We hope to host you in the future!</p>
                @elseif($booking->status === 'completed')
                    <p class="completed">Thank you for staying with us. We hope you had a great experience!</p>
                @endif
                
                
            </div>
        </div>


        <div class="details">
          <h2>Booking Details</h2>
          <div style="display: flex; flex-wrap: wrap; gap: 20px;">
              <div style="flex: 1 1 45%;">
                  <p><i class="fa fa-bed fa-fw"></i> <strong>Bedroom:</strong> {{$booking->listing->bedrooms }} </p>
                  <p><i class="fas fa-bath fa-fw"></i> <strong>Bathroom:</strong> {{$booking->listing->bathrooms }} </p>
                  <p><i class="fa fa-calendar-days fa-fw"></i><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($booking->startDate)->format('d F Y') }}</p>
                  <p><i class="fa fa-calendar-xmark fa-fw"></i><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($booking->endDate)->format('d F Y') }}</p>
              </div>
              <div style="flex: 1 1 45%;">
                  <p><strong>Total Amount:</strong> RM {{$booking->total_price }}</p>

                    @if($booking->status === 'booked')
                        <p><strong>Booked on:</strong> {{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}</p>
                    @elseif($booking->status === 'cancelled')
                        <p><strong>Cancelled on:</strong> {{ \Carbon\Carbon::parse($booking->updated_at)->format('d F Y') }}</p>
                    @elseif($booking->status === 'completed')
                        <p><strong>Completed on:</strong> {{ \Carbon\Carbon::parse($booking->endDate)->format('d F Y') }}</p>
                    @endif

                  
              </div>
              
          </div>
      </div>



        <div class="details">
            <h2>Host Information</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                <div style="flex: 1 1 45%;">
                    <p><strong>Name:</strong> {{$booking->listing->user->name }}</p>
                    <p><strong>Email:</strong> {{$booking->listing->user->email }}</p>
                    <p><strong>Contact No:</strong> {{$booking->listing->user->contact_no }}</p>
                </div>
                <div style="flex: 1 1 45%;">
                    <p><strong>Host Since:</strong> {{ \Carbon\Carbon::parse($booking->listing->user->created_at)->format('F Y') }}</p>
                    <p><strong>Response Time:</strong> Within a few hours</p>
                </div>
            </div>
        </div>


    </div>
    <footer>
        &copy; 2025 Travella. All rights reserved.
    </footer>
</body>
<script>
function openPrintWindow(bookingId) {
  const url = `/booking/print/${bookingId}`;
  window.open(url, 'PrintWindow', 'width=800,height=1100');
}
</script>
</html>
