<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function SiteSetting()
    {
        $site = SiteSetting::first();
        return view('backend.setting.site_update', compact('site'));
    }

    public function SiteUpdate(Request $request)
    {
        $setting = SiteSetting::first();
        $filename = null;

        if ($request->hasFile('logo')) {
            $filename = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs('uploads', $filename, 'public');
        }

        $setting->phone = $request->phone;
        $setting->address = $request->address;
        $setting->email = $request->email;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        if ($filename) {
            $setting->logo = $filename;
        }
        $setting->save();

        return redirect()->back()->with([
            'message' => 'Site setting updated!',
            'alert-type' => 'success'
        ]);
    }
}
