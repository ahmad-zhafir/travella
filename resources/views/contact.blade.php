<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Travella | Contact Us</title>
  <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
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
  <main role="main" class="container" aria-label="Contact Us Form">
    <h1>Contact Us</h1>
    <p class="description">Have questions or feedback? Send us a message and we'll get back to you shortly.</p>
    <form id="contactForm" novalidate>
      <div>
        <label for="nameInput">Name</label>
        <input type="text" id="nameInput" name="name" placeholder="Your full name" autocomplete="name" required
          aria-required="true" />
      </div>
      <div>
        <label for="emailInput">Email</label>
        <input type="email" id="emailInput" name="email" placeholder="you@example.com" autocomplete="email" required
          aria-required="true" />
      </div>
      <div>
        <label for="typeSelect">Type of Message</label>
        <select id="typeSelect" name="type" required aria-required="true">
          <option value="" disabled selected>Select message type</option>
          <option value="General Inquiry">General Inquiry</option>
          <option value="Support">Support</option>
          <option value="Feedback">Feedback</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div>
        <label for="messageInput">Message</label>
        <textarea id="messageInput" name="message" placeholder="Write your message here" required aria-required="true"
          rows="5"></textarea>
      </div>
      <button type="submit" class="send-btn" aria-label="Send message">
        Send
        <span class="material-icons" aria-hidden="true">send</span>
      </button>
    </form>
  </main>
  <footer>
    &copy; 2025 Travella. All rights reserved.
  </footer>
<script>
  const form = document.getElementById('contactForm');
  const nameInput = form.querySelector('#nameInput');
  const emailInput = form.querySelector('#emailInput');
  const typeSelect = form.querySelector('#typeSelect');
  const messageInput = form.querySelector('#messageInput');
  const sendBtn = form.querySelector('button.send-btn');

  // ✅ Auto-fill name and email if logged in
  fetch('/user-info')
    .then(response => {
      if (response.ok) return response.json();
      throw new Error('Not authenticated');
    })
    .then(data => {
      if (data.name && data.email) {
        nameInput.value = data.name;
        emailInput.value = data.email;
        updateButtonState();
      }
    })
    .catch(() => {});

  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  function updateButtonState() {
    const isValid = nameInput.value.trim() !== '' &&
      isValidEmail(emailInput.value.trim()) &&
      typeSelect.value.trim() !== '' &&
      messageInput.value.trim() !== '';
    sendBtn.disabled = !isValid;
  }

  updateButtonState();

  [nameInput, emailInput, typeSelect, messageInput].forEach(input => {
    input.addEventListener('input', updateButtonState);
  });

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const name = nameInput.value.trim();
    const email = emailInput.value.trim();
    const type = typeSelect.value.trim();
    const message = messageInput.value.trim();

    if (!name || !email || !message || !type || !isValidEmail(email)) {
      alert('Please complete all fields with a valid email.');
      return;
    }

    const subject = encodeURIComponent(`Contact (${type}) from ${name}`);
    const body = encodeURIComponent([
      `Name: ${name}`,
      `Email: ${email}`,
      `Type of Message: ${type}`,
      '',
      `Message:`,
      `${message}`
    ].join('\n'));

    window.open(`https://mail.google.com/mail/?view=cm&fs=1&to=travella_support@gmail.com&su=${subject}&body=${body}`, '_blank');

    form.reset();
    updateButtonState();
  });
</script>

</body>

</html>