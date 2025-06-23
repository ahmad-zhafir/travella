<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;


class HostDashboardController extends Controller
{
    public function index()
    {
        $hostId = Auth::id();

        $listings = Listing::withCount(['bookings as bookings_count' => function ($query) {
            $query->where('status', 'booked');
        }])->where('user_id', $hostId)->get();

        return view('host.dashboard', compact('listings'));
    }
}
