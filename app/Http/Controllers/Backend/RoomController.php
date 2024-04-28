<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use App\Models\RoomNumber;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RoomController extends Controller
{
    public array $successNotif;
    public array $successUpdateNotif;

    public function __construct()
    {
        $this->successNotif = array(
            'message' => 'Room successfully added!',
            'alert-type' => 'success'
        );
        $this->successNotif = array(
            'message' => 'Room successfully updated!',
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

        $additionalData = [
            'roomtype_id' => $roomtype->id,
            'short_desc' => $request->short_desc,
            'status' => 0,
            'description' => $request->description
        ];

        if ($filename) {
            $additionalData['image'] = $filename;
        }

        $room = Room::create(array_merge($request->safe()->except(['roomtype']), $additionalData));

        if ($request->filled('facility_name')) {
            $facilities = Arr::map($request->get('facility_name'), function($item) {
                return ['facility_name' => $item];
            });
            $room->facilities()->createMany($facilities);
        }

        return redirect()->route('view.room')->with($this->successNotif);
    }

    public function EditRoom($id)
    {
        $editData = Room::findOrFail($id);
        $basic_facility = $editData->facilities;
        $allroomNo = $editData->all_room_numbers;

        return view('backend.allroom.rooms.edit_rooms', compact('editData', 'basic_facility', 'allroomNo'));
    }

    public function UpdateRoom($id, UpdateRoomRequest $request)
    {
        $room = Room::findOrFail($id);
        $filename = null;
        $roomtype = RoomType::firstOrCreate([
            'name' => $request->get('roomtype')
        ]);

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('uploads', $filename, 'public');
        }

        $additionalData = [
            'roomtype_id' => $roomtype->id,
            'short_desc' => $request->short_desc,
            'status' => 0,
            'description' => $request->description
        ];

        if ($filename) {
            $additionalData['image'] = $filename;
        }

        $room->update(array_merge($request->safe()->except(['roomtype']), $additionalData));

        if ($request->filled('facility_name')) {
            $facilities = Arr::map($request->get('facility_name'), function($item) {
                return ['facility_name' => $item];
            });
            $room->facilities()->delete();
            $room->facilities()->createMany($facilities);
        }

        return redirect()->back()->with($this->successNotif);
    }

    public function StoreRoomNumber($id, Request $request)
    {
        $room = Room::findOrFail($id);

        $room->room_numbers()->create($request->only(['room_no', 'status', 'room_type_id']));

        $this->successNotif['message'] = 'Room number successfully added!';
        return redirect()->back()->with($this->successNotif);
    }

    public function EditRoomNumber($id)
    {
        $editroomno = RoomNumber::findOrFail($id);

        return view('backend.allroom.rooms.edit_room_no', compact('editroomno'));
    }

    public function UpdateRoomNumber($id, Request $request)
    {
        $editroomno = RoomNumber::findOrFail($id);
        $editroomno->room_no = $request->room_no;
        $editroomno->status = $request->status;
        $editroomno->save();

        $this->successUpdateNotif['message'] = 'Room number successfully updated!';

        return redirect()->route('edit.room', $editroomno->room->id)->with($this->successUpdateNotif);
    }

    public function DeleteRoomNumber($id)
    {
        $editroomno = RoomNumber::findOrFail($id);
        $editroomno->delete();
        $this->successUpdateNotif['message'] = 'Room number successfully deleted!';

        return redirect()->route('edit.room', $editroomno->room->id)->with($this->successUpdateNotif);
    }
}
