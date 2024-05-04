<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendRoomController extends Controller
{
    public function RoomDetailsPage($id)
    {
        $roomdetails = Room::findOrFail($id);
        $facility = $roomdetails->facilities;
        $otherRooms = Room::where('id', '!=', $id);
        return view('frontend.room.room_details', compact('roomdetails', 'facility', 'otherRooms'));
    }

    public function BookingSeach(Request $request)
    {
        $bookings = Booking::where(function($q) use($request) {
            return $q->whereBetween('check_in', [$request->check_in, $request->check_out])
                    ->orWhereBetween('check_out', [$request->check_in, $request->check_out]);
        })->get();
        $rooms = Room::all();
        $check_date_booking_ids = $bookings->pluck('id');

        $check_in = $request->get('check_in');
        $check_out = $request->get('check_out');
        $persion = $request->get('persion');

        return view('frontend.room.search_room', compact('rooms', 'check_date_booking_ids', 'check_in', 'check_out', 'persion'));
    }

    public function SearchRoomDetails($id, Request $request)
    {
        $roomdetails = Room::findOrFail($id);
        $facility = $roomdetails->facilities;
        $otherRooms = Room::where('id', '!=', $roomdetails->id)->get();
        $av_room = $request->get('av_room');

        $checkoutDt = Carbon::createFromFormat('Y-m-d', $request->get('check_out'));
        $checkinDt = Carbon::createFromFormat('Y-m-d', $request->get('check_in'));

        $totalNights = $checkinDt->diffInDays($checkoutDt, true);
        $room_id = $id;

        return view('frontend.room.search_room_details', compact('av_room', 'roomdetails', 'facility', 'otherRooms', 'room_id', 'totalNights'));
    }

    public function CheckRoomAvailability(Request $request)
    {
        $room = Room::find($request->room_id);

        if (!$room) {
            return response()->json(['message' => "Room id: {$request->room_id} not found"], 404);
        }

        $roomBookings = $room->bookings()
                            ->withCount('assign_rooms')
                            ->where(function($q) use($request) {
                                return $q->whereBetween('check_in', [$request->check_in, $request->check_out])
                                        ->orWhereBetween('check_out', [$request->check_in, $request->check_out]);
                            })
                            ->get()
                            ->sum('assign_rooms_count');
        $av_room = $room->room_numbers->count();

        if ($roomBookings) {
            $av_room -= $roomBookings;
        }

        $checkoutDt = Carbon::createFromFormat('Y-m-d', $request->get('check_out'));
        $checkinDt = Carbon::createFromFormat('Y-m-d', $request->get('check_in'));
        $totalNights = $checkinDt->diffInDays($checkoutDt, true);

        return response()->json([
            'total_nights' => $totalNights,
            'available_room' => $av_room
        ]);
    }
}
