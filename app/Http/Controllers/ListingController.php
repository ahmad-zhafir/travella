<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display the specified listing details.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Fetch listing by ID with related photos (adjust relationship name if needed)
        $listing = Listing::with(['amenities', 'photos'])->findOrFail($id);

        // Return the view with the listing data
        return view('listing', compact('listing'));
    }
}
