<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class UpdateBookingStatus
{
   public function handle(Request $request, Closure $next)
{
    Log::info('Middleware triggered: UpdateBookingStatus');

    $now = Carbon::now();
    Log::info('Current time: ' . $now->toDateTimeString());

    $bookingsToUpdate = Booking::where('status', 'booked')
        ->whereDate('endDate', '<', $now->toDateString())
        ->get();

    Log::info('Bookings matched: ' . $bookingsToUpdate->count());

    foreach ($bookingsToUpdate as $booking) {
        $booking->status = 'completed';
        $booking->save();
        Log::info('Updated booking ID: ' . $booking->id);
    }

    return $next($request);
}

}
