<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;



class HostListingController extends Controller
{
    /**
     * Display a list of the host's listings.
     */
    public function index()
    {
        $hostId = Auth::id(); // Get the authenticated user's ID
        $listings = Listing::where('user_id', $hostId)->get();

        return view('host.listings.index', compact('listings'));
    }

    /**
     * Show the form for creating a new listing.
     */
    public function create()
    {
        return view('host.addlisting');
    }

    /**
     * Store a newly created listing.
     */
public function store(Request $request)
{
    Log::info('Store method hit');

    try {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'amenities' => 'required|array',
            'amenities.*' => 'integer|exists:amenities,id',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);
    } catch (ValidationException $e) {
        Log::error('Validation failed: ' . json_encode($e->errors()));
        return back()->withErrors($e->errors())->withInput();
    }

    $user = Auth::user();

    try {
        // 1. Create the listing
        Log::info('Before creating listing');

        $listing = Listing::create([
            'title' => $request->title,
            'location' => $request->location,
            'price' => $request->price,
            'description' => $request->description,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'user_id' => $user->id,
            'state' => 'active',
        ]);
        Log::info('Listing created with ID: ' . $listing->id);

        // 2. Attach amenities
        $listing->amenities()->attach($request->amenities);
        Log::info('Amenities attached: ' . implode(',', $request->amenities));

        // 3. Upload images and save photo records
        foreach ($request->file('images') as $image) {
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $filename);

            $listing->photos()->create([
                'path' => 'uploads/' . $filename,
            ]);
            Log::info('Photo saved: ' . 'uploads/' . $filename);
        }

        Log::info('Store method completed successfully');

        return redirect()->route('host.dashboard')->with('success', 'Listing created successfully!');
    } catch (\Exception $e) {
        Log::error('Error creating listing: ' . $e->getMessage());
        return back()->withErrors('Failed to create listing. Please try again.');
    }
}





    /**
     * Show the form for editing an existing listing.
     */
public function edit($id)
{
    $listing = Listing::with(['amenities', 'photos'])
                      ->where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

    $allAmenities = \App\Models\Amenity::all();

    return view('host.edit', compact('listing', 'allAmenities'));
}

    /**
     * Update the specified listing.
     */
    public function update(Request $request, $id)
{
    $listing = Listing::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

    $request->validate([
        'title' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'required|string',
        'bedrooms' => 'required|integer|min:0',
        'bathrooms' => 'required|integer|min:0',
        'amenities' => 'required|array',
        'amenities.*' => 'integer|exists:amenities,id',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
    ]);

    $listing->update([
        'title' => $request->title,
        'location' => $request->location,
        'price' => $request->price,
        'description' => $request->description,
        'bedrooms' => $request->bedrooms,
        'bathrooms' => $request->bathrooms,
    ]);

    $listing->amenities()->sync($request->amenities);

    // Add new images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $filename);

            $listing->photos()->create([
                'path' => 'uploads/' . $filename,
            ]);
        }
    }

    return redirect()->route('host.dashboard')->with('success', 'Listing updated successfully!');
}

    public function deletePhoto(Photo $photo)
    {
        // Make sure the user owns the listing the photo belongs to
        if ($photo->listing->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete image file
        if (file_exists(public_path($photo->path))) {
            unlink(public_path($photo->path));
        }

        $photo->delete();

        return response()->json(['success' => true]);
    }



    /**
     * Delete the specified listing.
     */
    public function destroy($id)
    {
        $listing = Listing::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();

        $listing->delete();

        return redirect()->route('host.dashboard')->with('deleteSuccess', true);;
    }

    public function toggleState($id)
{
    $listing = Listing::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

    $listing->state = $listing->state === 'active' ? 'inactive' : 'active';
    $listing->save();

    return response()->json([
        'success' => true,
        'new_state' => $listing->state,
    ]);
}

}
