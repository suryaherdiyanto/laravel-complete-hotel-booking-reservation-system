<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Support\Arr;

class RoomController extends Controller
{
    public array $successNotif;

    public function __construct()
    {
        $this->successNotif = array(
            'message' => 'Room successfully added!',
            'alert-type' => 'success'
        );
    }

    public function ViewRoomNo()
    {
        $rooms = Room::all();

        return view('backend.allroom.rooms.view_rooms', compact('rooms'));
    }

    public function AddRoom()
    {
        return view('backend.allroom.rooms.add_room');
    }

    public function StoreRoom(StoreRoomRequest $request)
    {
        $filename = null;
        $roomtype = RoomType::firstOrCreate([
            'name' => $request->get('roomtype')
        ]);

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('uploads', $filename, 'public');
        }

        $room = Room::create(array_merge($request->safe()->except(['roomtype']), [
            'roomtype_id' => $roomtype->id,
            'short_desc' => $request->short_desc,
            'status' => 0,
            'image' => $filename
        ]));

        if ($request->filled('facility_name')) {
            $facilities = Arr::map($request->get('facility_name'), function($item) {
                return ['facility_name' => $item];
            });
            $room->facilities()->createMany($facilities);
        }

        return redirect()->route('view.room')->with($this->successNotif);
    }
}
