<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Travella | Host Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/host.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
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

  <div class="container" role="main">
    <div class="welcome-msg">
      Welcome back, <strong>{{ Auth::user()->name }}</strong>! Here's what’s happening with your listings.
    </div>

    <section aria-label="Your Listings">
      <div class="listings-header">
        <h2>Your Listings</h2>
        <a class="btn-primary" href="{{ route('host.listings.create') }}" aria-label="Add new listing">+ Add New Listing</a>
      </div>

      <div class="listings" id="listingsContainer" aria-live="polite">
        @forelse($listings as $listing)
          <article class="listing-card" tabindex="0">
            <img src="{{ asset($listing->firstPhoto->path) }}" alt="{{ $listing->title }}" class="listing-img" loading="lazy" />
            <div class="listing-content">
              <div class="listing-title-row">
                <h3 class="listing-title">{{ $listing->title }}</h3>
                <div class="listing-switch-group">
                  <span
                    id="state-label-{{ $listing->id }}"
                    class="state-label {{ $listing->state === 'active' ? 'state-active' : 'state-inactive' }}">
                    {{ ucfirst($listing->state) }}
                  </span>
                  <label class="switch">
                    <input type="checkbox"
                          class="state-toggle"
                          data-id="{{ $listing->id }}"
                          {{ $listing->state === 'active' ? 'checked' : '' }}>
                    <span class="slider"></span>
                  </label>
                </div>
              </div>
              
              <p class="listing-location">{{ $listing->location }}</p>
              <div class="listing-footer">
                @if($listing->bookings_count > 1)
                  {{ $listing->bookings_count }} Upcoming Bookings
                @elseif($listing->bookings_count === 1)
                  1 Upcoming Booking
                @else
                  No Upcoming Bookings
                @endif
              </div>
<div class="btn-group" role="group" aria-label="Actions for {{ $listing->title }}">
  {{-- Manage Bookings --}}
  <form action="{{ route('host.listing.bookings', ['listing' => $listing->id]) }}" method="GET" style="display: inline;">
  <button type="submit" class="btn-action" aria-label="Manage bookings">
    <i class="fa-solid fa-calendar-check" aria-hidden="true"></i> Manage Bookings
  </button>
</form>

 {{-- Edit Listing --}}
  <form action="{{ route('host.listings.edit', $listing->id) }}" method="GET" style="display: inline;">
    <button type="submit" class="btn-action" aria-label="Edit listing">
      <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i> Edit
    </button>
  </form>

<form style="display: inline;">
  <button type="button"
          class="btn-action"
          onclick="openDeleteModal({{ $listing->id }})"
          aria-label="Delete listing">
    <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete
  </button>
</form>

            </div>
          </article>
        @empty
          <p>No listings available. Click 'Add New Listing' to create one.</p>
        @endforelse
      </div>
    </section>
  </div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="modal" style="display:none;">
    <div class="modal-content">
        <h2>Delete This Listing?</h2>
        <p>This action cannot be undone. Do you wish to continue?</p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-buttons">
                <button type="submit" class="btn-close">Yes, Delete</button>
                <button type="button" class="btn-close" onclick="closeDeleteModal()">No, Go Back</button>
            </div>
        </form>
    </div>
</div>

@if(session('deleteSuccess'))
<div id="deleteSuccessModal" class="modal">
    <div class="modal-content">
        <h2>Listing Deleted</h2>
        <p>Your listing has been successfully deleted.</p>
        <div class="modal-buttons">
                <button type="button" class="btn-close" onclick="closeDeleteSuccessModal()">Close</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('deleteSuccessModal').style.display = 'block';
    });
</script>
@endif

<!-- State Toggle Confirmation Modal -->
<div id="stateConfirmModal" class="modal" style="display: none;">
  <div class="modal-content">
    <h2 id="stateModalTitle">Change Listing Status?</h2>
    <p id="stateModalMessage">Are you sure you want to change the state?</p>
    <div class="modal-buttons">
      <button type="button" class="btn-close" onclick="confirmStateChange()">Yes, Change</button>
      <button type="button" class="btn-close" onclick="cancelStateChange()">No, Cancel</button>
    </div>
  </div>
</div>


  <footer>&copy; 2025 Travella. All rights reserved.</footer>
</body>
<script>
let pendingToggle = null;
let intendedState = '';

document.querySelectorAll('.state-toggle').forEach(toggle => {
    toggle.addEventListener('change', function (e) {
        e.preventDefault();

        pendingToggle = this;
        intendedState = this.checked ? 'active' : 'inactive';

        // Revert immediately until confirmed
        this.checked = !this.checked;

        // Set modal message
        const title = document.getElementById('stateModalTitle');
        const message = document.getElementById('stateModalMessage');

        if (intendedState === 'inactive') {
            title.textContent = 'Change Listing Status to Inactive?';
            message.textContent = 'You will no longer receive new bookings for this listing.';
        } else {
            title.textContent = 'Change Listing Status to Active?';
            message.textContent = 'Guests will now be able to view and book this listing.';
        }

        // Show modal
        document.getElementById('stateConfirmModal').style.display = 'block';
    });
});

function confirmStateChange() {
    if (!pendingToggle) return;

    const listingId = pendingToggle.dataset.id;
    const csrfToken = '{{ csrf_token() }}';

    fetch(`/host/listings/${listingId}/toggle-state`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        const label = document.getElementById('state-label-' + listingId);
        if (label && data.new_state) {
            const newState = data.new_state.charAt(0).toUpperCase() + data.new_state.slice(1);
            label.textContent = newState;

            label.classList.remove('state-active', 'state-inactive');
            if (data.new_state === 'active') {
                label.classList.add('state-active');
                pendingToggle.checked = true;
            } else {
                label.classList.add('state-inactive');
                pendingToggle.checked = false;
            }
        }

        // ✅ Close the modal after success
        closeStateModal();
        pendingToggle = null;
    })
    .catch(error => {
        console.error('Error toggling state:', error);
        alert('Something went wrong.');
        pendingToggle.checked = !pendingToggle.checked;
        pendingToggle = null;
        closeStateModal();
    });
}


function cancelStateChange() {
    pendingToggle = null;
    closeStateModal();
}

function closeStateModal() {
    document.getElementById('stateConfirmModal').style.display = 'none';
}



function openDeleteModal(listingId) {
    const form = document.getElementById('deleteForm');
    form.action = `/host/listings/${listingId}`; // make sure this matches your route
    document.getElementById('deleteConfirmModal').style.display = 'block';
}

    function closeDeleteModal() {
        document.getElementById('deleteConfirmModal').style.display = 'none';
    }

        function closeDeleteSuccessModal() {
        document.getElementById('deleteSuccessModal').style.display = 'none';
    }
</script>

</html>
