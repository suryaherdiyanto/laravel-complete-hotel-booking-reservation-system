<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function BookingReport(Request $request)
    {
        return view('backend.report.booking_report');
    }

    public function SearchByDate(Request $request)
    {
        $bookings = Booking::whereBetween('check_in', [$request->start_date, $request->end_date])
                            ->orWhereBetween('check_out', [$request->start_date, $request->end_date])
                            ->get();
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        return view('backend.report.booking_search_date', compact('bookings', 'startDate', 'endDate'));
    }
}
