<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
public function index()
{
    $listings = Listing::with('firstPhoto')
        ->where('state', 'active') // ✅ Only active listings
        ->inRandomOrder()          // 🔀 Fetch random order
        ->take(3)                  // 🎯 Limit to 3
        ->get();

    return view('home', compact('listings'));
}

    public function search(Request $request)
    {
        $data = $request->validate([
            'location' => 'required|string',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
        ]);

        $checkin = Carbon::parse($data['checkin']);
        $checkout = Carbon::parse($data['checkout']);

        $listings = Listing::where('location', 'LIKE', '%' . $data['location'] . '%')
            ->where('state', 'active') // ✅ Only active listings
            ->whereDoesntHave('bookings', function ($query) use ($checkin, $checkout) {
                $query->where(function ($q) use ($checkin, $checkout) {
                    $q->where('status', 'booked')
                      ->orWhere(function ($subQ) {
                          $subQ->where('status', 'cancelled')
                               ->where('availability', 'no');
                      });
                })
                ->where(function ($dateOverlap) use ($checkin, $checkout) {
                    $dateOverlap->where(function ($q) use ($checkin, $checkout) {
                        $q->where('startDate', '<', $checkout)
                          ->where('endDate', '>', $checkin);
                    });
                });
            })
            ->with(['photos' => function ($query) {
                $query->limit(1);
            }])
            ->get();

        return view('search', [
            'listings' => $listings,
            'location' => $data['location'],
            'checkin' => $data['checkin'],
            'checkout' => $data['checkout']
        ]);
    }


public function searchByListing(Request $request)
{
    $data = $request->validate([
        'listingId' => 'required|integer|exists:listings,id',
        'checkin' => 'required|date',
        'checkout' => 'required|date|after:checkin',
    ]);

    $checkin = Carbon::parse($data['checkin']);
    $checkout = Carbon::parse($data['checkout']);

    $listing = Listing::where('id', $data['listingId'])
        ->whereDoesntHave('bookings', function ($query) use ($checkin, $checkout) {
            $query->where(function ($q) {
                $q->where('status', 'booked')
                  ->orWhere(function ($subQ) {
                      $subQ->where('status', 'cancelled')
                           ->where('availability', 'no');
                  });
            })
            ->where(function ($dateOverlap) use ($checkin, $checkout) {
                $dateOverlap->where(function ($q) use ($checkin, $checkout) {
                    $q->where('startDate', '<', $checkout)
                      ->where('endDate', '>', $checkin);
                });
            });
        })
        ->with(['photos' => function ($query) {
            $query->limit(1);
        }])
        ->first();

    if ($request->ajax()) {
        if ($listing) {
            return response()->json([
                'success' => true,
                'redirectUrl' => route('listing.show', [
                    'id' => $listing->id,
                    'checkin' => $data['checkin'],
                    'checkout' => $data['checkout'],
                ]),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'The selected date is not available.',
            ]);
        }
    }

    // Fallback for non-AJAX
    if (!$listing) {
        return redirect()->back()->withErrors(['The selected date is not available.']);
    }

    // Redirect to listing detail view
    return redirect()->route('listing.show', [
        'id' => $listing->id,
        'checkin' => $data['checkin'],
        'checkout' => $data['checkout'],
    ]);
}



}
