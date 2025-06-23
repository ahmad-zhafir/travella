<html>
<head>
  <title>Booking Details</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      padding: 30px;
      line-height: 1.6;
      background: #fff;
      color: #333;
      font-size: 16px;
    }

    h1{
      color: #ff385c;
      text-align: center;
      padding-bottom: 10px;
    }

    h2 {
      color: #ff385c;
      border-bottom: 1px solid #ccc;
      padding-bottom: 5px;
    }

    .section {
      margin-bottom: 25px;
    }

    .label {
      font-weight: bold;
    }

    .highlight {
      background-color: #f0f8ff;
      padding: 5px 10px;
      border-radius: 6px;
    }

    .image img {
      width: 300px;
      height: 180px;
      border-radius: 8px;
      object-fit: cover;
    }

    .title {
      font-size: 26px;
      font-weight: bold;
    }

    .location {
      color: #000;
      margin-top: 4px;
    }

    /* Bigger & cleaner for print */
    @media print {
      @page {
        size: A4;
        margin: 10mm;
      }

      body {
        font-size: 16px;
        padding: 0;
      }

      h1 {
        font-size: 24px;
      }

      h2 {
        font-size: 20px;
      }

      .title {
        font-size: 22px;
      }

      .image img {
        width: 30%;
        height: auto;
        max-height: 250px;
      }

      .section {
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body>

  <h1>Travella Booking Summary</h1>

  <div class="section">
    <div class="image">
        <img src="{{ asset(($booking->listing->photos->first()->path ?? 'placeholder.jpg')) }}" alt="{{ $booking->listing->title }}" />
    </div>
    <div class="title">{{$booking->listing->title }}</div>
    <div class="location">{{$booking->listing->location }}</div>
  </div>

  <div class="section">
    <h2>Booking Details</h2>
    <p><span class="label">Booking ID:</span> {{$booking->id }}</p>
    <p><span class="label">Check-in:</span> {{ \Carbon\Carbon::parse($booking->startDate)->format('d F Y') }} (2:00 PM)</p>
    <p><span class="label">Check-out:</span> {{ \Carbon\Carbon::parse($booking->endDate)->format('d F Y') }} (12:00 PM)</p>
    <p><span class="label">Duration:</span> {{$booking->days }} night(s)</p>
    <p><span class="label">Total Price:</span> RM {{$booking->total_price }}</p>
  </div>

  <div class="section">
    <h2>Guest Information</h2>
    <p><span class="label">Name:</span> {{$booking->name }}</p>
    <p><span class="label">Email:</span> {{$booking->email }}</p>
    <p><span class="label">Contact No:</span> {{$booking->contact_no }}</p>
  </div>

  <div class="section">
    <h2>Host Information</h2>
    <p><span class="label">Name:</span> {{$booking->listing->user->name }}</p>
    <p><span class="label">Email:</span> {{$booking->listing->user->email }}</p>
    <p><span class="label">Contact No:</span> {{$booking->listing->user->contact_no }}</p>
  </div>

<p style="text-align: center; font-style: italic; font-size: 0.9rem; margin-top: 40px;">
    Thank you for booking with Travella. We hope you have a wonderful stay!
</p>

</body>
  <script>
    window.onload = function () {
      window.print();
    };
  </script>
</html>