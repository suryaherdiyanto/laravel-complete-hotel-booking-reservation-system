<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomListController extends Controller
{
    public function ViewRoomList()
    {
        $rooms = Room::all();

        return view('backend.allroom.roomlist.view_roomlist', compact('rooms'));
    }

    public function AddRoomList()
    {
        $roomtype = RoomType::all();
        return view('backend.allroom.roomlist.add_roomlist', compact('roomtype'));
    }
}
