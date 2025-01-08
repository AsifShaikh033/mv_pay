<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function list()
    {
        $banners = Banner::orderBy('priority', 'asc')->get();
        return view('Admin.Banner.list', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
          //  'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'priority' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $folderPath = 'public/uploads/banner';
        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath);
        }
        $imageName=  $request->file('image')->store('uploads/banner', 'public');

        Banner::create([
            'image' => $imageName,
            'priority' => $request->priority,
            'details' => 'banner',
            'banner_type' => 'top',
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Banner created successfully.');
    }

    public function banner_edit($id)
    {
        $Data = Banner::find($id);
        return view('Admin.Banner.edit', compact('Data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'priority' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $banner = Banner::findOrFail($id);
        if ($request->hasFile('image')) {
            $banner->image=  $request->file('image')->store('uploads/banner', 'public');
        }

        $banner->priority = $request->priority;
        $banner->status = $request->status;
        $banner->save();

     //   return redirect()->back()->with('success', 'Banner updated successfully.');
        return redirect()->route('admin.banner.list')->with('success', 'Banner updated successfully');
    }


    public function destroy(Request $request)
    {
        $banner = Banner::findOrFail($request->id);
        $banner->delete();
        return redirect()->back()->with('success', 'Banner deleted successfully.');
    }
    
}
