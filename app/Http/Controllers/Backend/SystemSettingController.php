<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    public function index()
    {
        $setting = SystemSetting::where('key', 'report_lock_status')->first();
        return view('system_setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = SystemSetting::where('key', 'report_lock_status')->first();
        if ($setting) {
            $setting->update(['value' => $request->status]);
        } else {
            SystemSetting::create([
                'key' => 'report_lock_status',
                'value' => $request->status,
            ]);
        }

        $notification = array(
            'message' => 'Pengaturan berhasil diperbarui',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
