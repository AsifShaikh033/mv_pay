<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BalanceCashback;
use Illuminate\Support\Facades\Storage;

class BalanceCashbackController extends Controller
{
    public function list()
    {
        $balanceCashbacks = BalanceCashback::orderBy('id', 'desc')->get();
        return view('Admin.balance_cashback.list', compact('balanceCashbacks'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'balance' => 'required|integer',
            'cashback' => 'required|integer',
            'status' => 'required|boolean',
        ]);



        BalanceCashback::create([
          
            'balance' => $request->balance,
            'cashback' => $request->cashback,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Balance Cashback created successfully.');
    }

    public function edit($id)
    {
        $Data = BalanceCashback::find($id);
        return view('Admin.balance_cashback.edit', compact('Data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'balance' => 'required|integer',
            'cashback' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $balanceCashback = BalanceCashback::findOrFail($id);


        $balanceCashback->balance = $request->balance;
        $balanceCashback->cashback = $request->cashback;
        $balanceCashback->status = $request->status;
        $balanceCashback->save();

     //   return redirect()->back()->with('success', 'Banner updated successfully.');
        return redirect()->route('admin.balance.cashback.list')->with('success', 'Banner updated successfully');
    }


    public function destroy(Request $request)
    {
        $banner = BalanceCashback::findOrFail($request->id);
        $banner->delete();
        return redirect()->back()->with('success', 'Balance Cashback deleted successfully.');
    }
    
}
