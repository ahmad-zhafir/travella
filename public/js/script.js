  window.addEventListener('DOMContentLoaded', () => {
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');

    // Set today's date as the minimum for check-in
    const today = new Date();
    const todayStr = today.toISOString().split('T')[0];
    checkinInput.min = todayStr;

    // When check-in changes
    checkinInput.addEventListener('change', () => {
      const checkinDate = new Date(checkinInput.value);
      if (isNaN(checkinDate)) return;

      // Set checkout's min date to check-in + 1 day
      const minCheckoutDate = new Date(checkinDate);
      minCheckoutDate.setDate(minCheckoutDate.getDate() + 1);

      const minCheckoutStr = minCheckoutDate.toISOString().split('T')[0];
      checkoutInput.min = minCheckoutStr;

      // Optional: auto-set checkout if it's before the new min
      if (checkoutInput.value < minCheckoutStr) {
        checkoutInput.value = minCheckoutStr;
      }
    });
  });
  
  
  
  
  window.addEventListener('DOMContentLoaded', () => {
    const modalCheckin = document.getElementById('modalCheckin');
    const modalCheckout = document.getElementById('modalCheckout');

    // Set today's date as the minimum for modal check-in
    const today = new Date();
    const todayStr = today.toISOString().split('T')[0];
    modalCheckin.min = todayStr;

    // When modal check-in changes
    modalCheckin.addEventListener('change', () => {
      const checkinDate = new Date(modalCheckin.value);
      if (isNaN(checkinDate)) return;

      // Set checkout min to check-in + 1 day
      const minCheckoutDate = new Date(checkinDate);
      minCheckoutDate.setDate(minCheckoutDate.getDate() + 1);
      const minCheckoutStr = minCheckoutDate.toISOString().split('T')[0];
      modalCheckout.min = minCheckoutStr;

      // Auto-adjust checkout if it’s invalid
      if (!modalCheckout.value || modalCheckout.value < minCheckoutStr) {
        modalCheckout.value = minCheckoutStr;
      }
    });
  });

  function openDateModal(listingId) {
    document.getElementById('modalListingId').value = listingId;
    document.getElementById('dateModal').style.display = 'block';

    // Reset date fields and enforce today's date
    const modalCheckin = document.getElementById('modalCheckin');
    const modalCheckout = document.getElementById('modalCheckout');

    modalCheckin.value = '';
    modalCheckout.value = '';
    modalCheckout.min = '';

    const today = new Date().toISOString().split('T')[0];
    modalCheckin.min = today;
  }

  function closeModal() {
    document.getElementById('dateModal').style.display = 'none';
  }

document.getElementById('dateForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const listingId = document.getElementById('modalListingId').value;
    const checkin = document.getElementById('modalCheckin').value;
    const checkout = document.getElementById('modalCheckout').value;

    if (listingId && checkin && checkout) {
        const url = `/search-by-listing?listingId=${encodeURIComponent(listingId)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}`;

        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.redirectUrl) {
                window.location.href = data.redirectUrl;
            } else {
                showPopup(data.message || 'Not available for the selected date.');
            }
        })
        .catch(error => {
            console.error('Fetch failed:', error);
            showPopup('Something went wrong. Please try again.');
        });
    } else {
        showPopup('Please fill in all fields.');
    }
});



function showPopup(message) {
  const errorEl = document.getElementById('dateModalError');
  errorEl.textContent = message || 'Not available for the selected date.';
  errorEl.style.display = 'block';
}
    function closePopup() {
        document.getElementById('popupModal').style.display = 'none';
    }


    function openDateModal(listingId) {
  document.getElementById('modalListingId').value = listingId;
  document.getElementById('dateModal').style.display = 'block';

  const modalCheckin = document.getElementById('modalCheckin');
  const modalCheckout = document.getElementById('modalCheckout');
  const errorEl = document.getElementById('dateModalError');

  modalCheckin.value = '';
  modalCheckout.value = '';
  modalCheckout.min = '';

  errorEl.textContent = '';
  errorEl.style.display = 'none';

  const today = new Date().toISOString().split('T')[0];
  modalCheckin.min = today;
}

function updateClock() {
  const now = new Date();

  const time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });

  const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
  const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

  const day = weekdays[now.getDay()];
  const date = now.getDate().toString().padStart(2, '0');
  const month = months[now.getMonth()];
  const year = now.getFullYear();

  const formattedDate = `${day}, ${date} ${month} ${year}`;

  document.getElementById('clock').textContent = time;
  document.getElementById('date').textContent = formattedDate;
}

setInterval(updateClock, 1000);
updateClock(); // run immediately
