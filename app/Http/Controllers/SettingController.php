<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // Get generic settings as key-value pairs
        $settings = Setting::pluck('value', 'key')->all();
        return view('backend.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Ensure keys exist or create them
        $keys = [
            'site_title',
            'site_tagline',
            'site_description',
            'address',
            'phone',
            'whatsapp',
            'email',
            'facebook',
            'instagram',
            'maps_iframe'
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return redirect()->route('admin.setting.index')->with('success', 'Pengaturan Website berhasil diperbarui');
    }
}
