<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class DesignController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('admin.design', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', 'logo_upload', 'hero_image_upload']);

        // Handle Logo Upload
        if ($request->hasFile('logo_upload')) {
            $request->validate([
                'logo_upload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $path = $request->file('logo_upload')->store('logos', 'public');
            $data['logo_image'] = '/storage/' . $path;
        }

        // Handle Hero Image Upload
        if ($request->hasFile('hero_image_upload')) {
            $request->validate([
                'hero_image_upload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            ]);

            $path = $request->file('hero_image_upload')->store('hero', 'public');
            $data['hero_image'] = '/storage/' . $path;
        }

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.design')->with('exito', 'Diseño actualizado correctamente');
    }

    public function deleteLogo()
    {
        $logo = SiteSetting::where('key', 'logo_image')->first();
        if ($logo) {
            $logo->delete();
        }
        return redirect()->route('admin.design')->with('exito', 'Logo eliminado correctamente');
    }
}
