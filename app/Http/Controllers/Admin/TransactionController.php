<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function list(Request $request)
    {
        $query = Transaction::with('user');
        if ($request->has('remark') && !empty($request->remark)) {
            $query->where('remark', $request->remark);
        }
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }
        $data = $query->orderBy('created_at', 'desc')->get();
        return view('Admin.Transaction.list', compact('data'));
    }
    
    
}
