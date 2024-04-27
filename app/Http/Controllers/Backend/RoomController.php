<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function ViewRoomNo()
    {
        $rooms = Room::all();

        return view('backend.allroom.rooms.view_rooms', compact('rooms'));
    }

    public function AddRoom()
    {
        return view('backend.allroom.rooms.add_room');
    }
}
