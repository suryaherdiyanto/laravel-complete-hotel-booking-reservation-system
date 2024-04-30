<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function BookingList()
    {
        $allData = Booking::all();
        return view('backend.booking.booking_list', compact('allData'));
    }

    public function Checkout(Request $request)
    {
        $room = Room::find($request->room_id);
        $checkin = Carbon::createFromFormat('m/d/Y', $request->checkin);
        $checkout = Carbon::createFromFormat('m/d/Y', $request->checkout);
        $nights = $checkin->diffInDays($checkout);
        $book_data = [
            'check_in' => $request->checkin,
            'check_out' => $request->checkout,
        ];

        return view('frontend.checkout.checkout', compact('room', 'nights', 'book_data'));
    }
}
