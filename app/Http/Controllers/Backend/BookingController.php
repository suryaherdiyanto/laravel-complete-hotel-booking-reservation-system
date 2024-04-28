<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function BookingList()
    {
        $allData = Booking::all();
        return view('backend.booking.booking_list', compact('allData'));
    }
}
