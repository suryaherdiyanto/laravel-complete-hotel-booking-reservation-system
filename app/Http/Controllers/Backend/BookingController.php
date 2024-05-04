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

    public function BookingStore(Request $request)
    {
        $room = Room::find($request->room_id);

        if (!$room) {
            abort(404);
        }

        $check_in = Carbon::createFromFormat('Y-m-d', $request->check_in);
        $check_out = Carbon::createFromFormat('Y-m-d', $request->check_out);
        $nights = $check_in->diffInDays($check_out);

        $book_data = $room->bookings()->create([
            'user_id' => auth()->user()->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'persion' => $request->persion,
            'number_of_rooms' => intval($request->number_of_rooms),
            'total_night' => $nights,
            'actual_price' => $room->price,
            'discount' => $room->discount,
            'subtotal' => ($room->price * $nights) - $room->discount,
            'payment_status' => 'pending',
            'status' => 1
        ]);

        return view('frontend.checkout.checkout', compact('room', 'nights', 'book_data'));
    }
}
