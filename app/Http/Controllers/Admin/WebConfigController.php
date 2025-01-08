<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebConfig;
use Illuminate\Support\Facades\Storage;
class WebConfigController extends Controller
{
    public function edit()
    {
        $config = WebConfig::first();
        return view('Admin.web_config.edit', compact('config'));
    }

    function update(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'web_title' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'primary_email' => 'nullable|email|max:255',
            'primary_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'color_primary' => 'nullable|string|max:20',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
        ]);

        // Fetch or create the web configuration record
        $config = WebConfig::first() ?? new WebConfig();

        // Update fields
        $config->fill($request->all());

        // Handle file uploads if necessary
        $folderPath = 'public/uploads/web_config';
        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath);
        }
    
        if ($request->hasFile('logo')) {
            $config->logo = $request->file('logo')->store('uploads/web_config', 'public');
        }
        if ($request->hasFile('icon')) {
            $config->icon = $request->file('icon')->store('uploads/web_config', 'public');
        }
        if ($request->hasFile('footer_logo')) {
            $config->footer_logo = $request->file('footer_logo')->store('uploads/web_config', 'public');
        }
        if ($request->hasFile('fav_icon')) {
            $config->fav_icon = $request->file('fav_icon')->store('uploads/web_config', 'public');
        }
        $config->maintenance_mode = $request->has('maintenance_mode') ? 1 : 0;
        $config->currency = 'USD';
        // Save configuration
        $config->save();

        return redirect()->route('admin.webconfig.edit')->with('success', 'Web configuration updated successfully!');
    }

}
