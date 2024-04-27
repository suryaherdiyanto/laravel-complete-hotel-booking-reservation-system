<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public array $successNotif;

    public function __construct()
    {
        $this->successNotif = array(
            'message' => 'Room type successfully added!',
            'alert-type' => 'success'
        );
    }
    public function RoomTypeList(Request $request)
    {
        $roomTypes = RoomType::when($request->filled('q'), function($q) use($request) {
            return $q->where('name', 'like', $request->q);
        })->get();

        return view('backend.allroom.roomtype.view_roomtype', compact('roomTypes'));
    }

    public function AddRoomType()
    {
        return view('backend.allroom.roomtype.add_roomtype');
    }

    public function RoomTypeStore(Request $request)
    {
        RoomType::create($request->only('name'));

        return redirect()->route('room.type.list')->with($this->successNotif);
    }
}
