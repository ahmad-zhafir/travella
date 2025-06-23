<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $location = $request->input('location');

        $listings = Listing::with(['photos' => function ($query) {
            $query->limit(1);
        }])
        ->when($location, function ($query, $location) {
            $query->where('location', 'LIKE', '%' . $location . '%');
        })
        ->get();

        return view('search', [
            'listings' => $listings,
            'location' => $location,
            'checkin' => $request->input('checkin'),
            'checkout' => $request->input('checkout')
        ]);
    }
}
