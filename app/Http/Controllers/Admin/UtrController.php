<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utr;
use Illuminate\Support\Facades\Storage;

class UtrController extends Controller
{
    public function list()
    {
        $utr_pay = Utr::get();
        return view('Admin.Utr.list', compact('utr_pay'));
    }

    public function store(Request $request)
    {
        $request->validate([
          //  'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        $folderPath = 'public/uploads/utr';
        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath);
        }
        $imageName=  $request->file('image')->store('uploads/utr', 'public');

        Utr::create([
            'image' => $imageName,
            'details' => 'utr',
            'utr_type' => 'top',
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'QR Code created successfully.');
    }

    public function utr_edit($id)
    {
        $Data = Utr::find($id);
        return view('Admin.Utr.edit', compact('Data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $utr = Utr::findOrFail($id);
        if ($request->hasFile('image')) {
            $utr->image=  $request->file('image')->store('uploads/utr', 'public');
        }

        $utr->status = $request->status;
        $utr->save();

     //   return redirect()->back()->with('success', 'Utr updated successfully.');
        return redirect()->route('admin.utr.list')->with('success', 'QR Code updated successfully');
    }


    public function destroy(Request $request)
    {
        $utr = Utr::findOrFail($request->id);
        $utr->delete();
        return redirect()->back()->with('success', 'Utr Code deleted successfully.');
    }
    
}
