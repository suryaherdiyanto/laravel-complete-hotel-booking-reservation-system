<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Room;
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
}
