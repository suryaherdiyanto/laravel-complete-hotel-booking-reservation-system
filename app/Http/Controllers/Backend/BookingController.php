<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingRoomList;
use App\Models\Room;
use App\Notifications\BookingComplete;
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

        $availableRoomNumbers = $room->room_numbers()->whereDoesntHave('bookings', function($q) use($request) {
            return $q->whereBetween('check_in', [$request->check_in, $request->check_out])->orWhereBetween('check_out', [$request->check_in, $request->check_out]);
        })->get()
        ->pluck('id');

        if (count($availableRoomNumbers) === 0 || count($availableRoomNumbers) < $request->number_of_rooms) {
            return redirect()->back()->with([
                'alert-type' => 'warning',
                'message' => 'Sorry there are no rooms available anymore!'
            ]);
        }

        $book_data = $room->bookings()->create([
            'user_id' => auth()->user()->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'persion' => $request->persion,
            'number_of_rooms' => intval($request->number_of_rooms),
            'total_night' => $nights,
            'actual_price' => $room->price,
            'discount' => $room->discount,
            'subtotal' => ($room->price * $nights),
            'total_price' => ($room->price * $nights) - $room->discount,
            'payment_status' => 0,
            'status' => 0,
            'code' => now()->timestamp
        ]);
        foreach ($availableRoomNumbers as $roomNumberId) {
            BookingRoomList::create([
                'booking_id' => $book_data['id'],
                'room_id' => $room->id,
                'room_number_id' => $roomNumberId
            ]);
        }

        return view('frontend.checkout.checkout', compact('room', 'nights', 'book_data'));
    }

    public function CheckoutStore(Request $request)
    {
        $booking = Booking::find($request->booking_id);
        $booking->name = $request->name;
        $booking->phone = $request->phone;
        $booking->country = $request->country;
        $booking->zip_code = $request->zip_code;
        $booking->state = $request->state;
        $booking->payment_method = $request->payment_method;
        $booking->save();

        $booking->user->notify(new BookingComplete($booking->name));

        return redirect('/')->with([
            'alert-type' => 'success',
            'message' => 'Your booking has been placed, We\'ll contacting you ASAP. You can see your booking details on you dashboard'
        ]);
    }

    public function UserBooking()
    {
        $allData = Booking::where('user_id', auth()->user()->id)->get();

        return view('frontend.dashboard.user_booking', compact('allData'));
    }

    public function EditBooking($id)
    {
        $editData = Booking::findOrFail($id);

        return view('backend.booking.edit_booking', compact('editData'));
    }

    public function AssignRoom($id)
    {
        $booking = Booking::find($id);
        $bookedRoomNumbers = $booking->assign_rooms->pluck('room_number_id');

        $room_numbers = $booking->room->room_numbers()->whereNotIn('id', $bookedRoomNumbers)->get();

        return view('backend.booking.assign_room', compact('room_numbers', 'booking'));
    }

    public function AssignRoomStore($booking_id, $room_number_id)
    {
        $booking = Booking::find($booking_id);
        BookingRoomList::create([
            'booking_id' => $booking_id,
            'room_id' => $booking->rooms_id,
            'room_number_id' => $room_number_id
        ]);

        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Room has been assigned!'
        ]);
    }

    public function AssignRoomDelete($id)
    {
        BookingRoomList::destroy($id);

        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Assigned room have been removed!'
        ]);
    }

    public function UpdateBookingStatus($id, Request $request)
    {

        $booking = Booking::find($id);
        $booking->payment_status = $request->payment_status;
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Booking status has been updated!'
        ]);
    }

    public function UpdateBooking($id, Request $request)
    {
        $booking = Booking::find($id);

        $booking->check_in = $request->check_in;
        $booking->check_out = $request->check_out;
        $booking->number_of_rooms = $request->number_of_rooms;
        $booking->save();

        $booking->assign_rooms()->delete();
        $assign_rooms = [];

        $availableRoomNumbers = $booking->room->room_numbers()->whereDoesntHave('bookings', function($q) use($booking) {
            return $q->whereBetween('check_in', [$booking->check_in, $booking->check_out])->orWhereBetween('check_out', [$booking->check_in, $booking->check_out]);
        })->get()
        ->pluck('id');

        for ($i=0; $i < $booking->number_of_rooms; $i++) {
            if (isset($availableRoomNumbers[$i])) {
                $assign_rooms[] = [
                    'room_id' => $booking->rooms_id,
                    'room_number_id' => $availableRoomNumbers[$i]
                ];
            }
        }
        $booking->assign_rooms()->createMany($assign_rooms);

        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Booking has been updated!'
        ]);
    }

    public function DownloadInvoice($id)
    {
        $editData = Booking::findOrFail($id);

        return view('backend.booking.booking_invoice', compact('editData'));
    }
}
