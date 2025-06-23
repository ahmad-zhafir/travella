<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    
// Display guest bookings
public function guestBookings()
{
    $user = Auth::user();

    $bookings = Booking::where('user_id', $user->id)
        ->orderBy('startDate')
        ->get()
        ->groupBy('status');

    return view('booking', ['guestBookings' => $bookings]);
}

// Display host bookings
public function showListingBookings($listingId)
    {
        $listing = Listing::with('bookings.user') // Adjust relation if needed
                          ->findOrFail($listingId);

        $bookings = $listing->bookings;

        return view('host.manage', [
            'listing' => $listing,
            'total' => $bookings->count(),
            'upcoming' => $bookings->where('status', 'booked'),
            'cancelled' => $bookings->where('status', 'cancelled'),
            'completed' => $bookings->where('status', 'completed'),
        ]);
    }

    // Display checkout page
public function showCheckout(Request $request)
{
    $listing = Listing::with('photos')->findOrFail($request->listing_id);

    return view('checkout', [
        'listing' => $listing,
        'checkin' => $request->checkin,
        'checkout' => $request->checkout,
        'bookingId' => session('bookingId'), // added
    ]);
}

    // 2. Book accommodation
    public function store(Request $request)
    {
        $this->validateBooking($request);

        if ($this->checkConflict($request->listing_id, $request->startDate, $request->endDate)) {
            return back()->withErrors('This date range is already booked.');
        }

    $booking = Booking::create([
        'user_id' => Auth::id(),
        'listing_id' => $request->listing_id,
        'startDate' => $request->startDate,
        'endDate' => $request->endDate,
        'status' => 'booked',
        'availability' => 'no',
        'name' => $request->name,
        'contact_no' => $request->contact_no,
        'email' => $request->email,
        'total_price' => $request->total_price,
        'days' => $request->days,
    ]);

            return redirect()->back()
        ->with('successfullyBooked', true)
        ->with('bookingId', $booking->id);
    }

    // 3. Cancel booking
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $user = Auth::user();

        if ($user->id !== $booking->user_id && $user->id !== $booking->listing->user_id) {
            abort(403);
        }

        $booking->status = 'cancelled';
        $booking->availability = ($user->id === $booking->user_id) ? 'yes' : 'no';
        $booking->save();

        return back()->with('cancelSuccess', true);
    }

    // 4. Validate booking request
    protected function validateBooking(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'startDate' => 'required|date|after_or_equal:today',
            'endDate' => 'required|date|after:startDate',
            'name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
            'email' => 'required|email',
            'total_price' => 'required|numeric|min:0',
            'days' => 'required|integer|min:1',
        ]);
    }

    // 5. Check for booking conflicts
    protected function checkConflict($listing_id, $start, $end)
    {
        return Booking::where('listing_id', $listing_id)
            ->where('availability', 'no')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('startDate', [$start, $end])
                      ->orWhereBetween('endDate', [$start, $end])
                      ->orWhere(function ($query) use ($start, $end) {
                          $query->where('startDate', '<=', $start)
                                ->where('endDate', '>=', $end);
                      });
            })
            ->exists();
    }

    public function showGuestBookingDetail($id)
    {
        // Fetch the booking by ID with related listing and user
        $booking = Booking::with(['listing.photos', 'listing.amenities'])
                    ->where('id', $id)
                    ->where('user_id', Auth::id()) // Ensure the guest owns the booking
                    ->firstOrFail();

        return view('detail', compact('booking'));
    }

    public function print($id)
    {
        $booking = Booking::with(['listing.photos', 'listing.user'])->findOrFail($id);
        return view('print', compact('booking'));
    }

}
