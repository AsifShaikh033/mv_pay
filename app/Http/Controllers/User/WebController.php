<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebConfig;
use App\Models\Banner;

class WebController extends Controller
{
   public function index()
   {
       // Fetch active banners sorted by priority
       $banners = Banner::where('status', 1)->orderBy('priority', 'asc')->get();

       // Example offers data (replace with a model query if you have an `Offer` model)
       $offers = [
           (object)[
               'image' => 'offer1.jpg',
               'title' => 'Discount on Recharge',
               'description' => 'Get up to 20% off on your next recharge.',
               'link' => '#'
           ],
           (object)[
               'image' => 'offer2.jpg',
               'title' => 'Cashback Offers',
               'description' => 'Earn cashback on every payment made.',
               'link' => '#'
           ],
           (object)[
               'image' => 'offer3.jpg',
               'title' => 'Special Deals',
               'description' => 'Check out our special deals for premium users.',
               'link' => '#'
           ],
       ];

    //    return view('Web.index', compact('banners', 'offers'));
       return view('Web.User.index', compact('banners', 'offers'));
   }

   public function other(){
        return view('Web.User.other');
   }
   
   public function bank_details(){
    $bankDetail = Bankdetail::first();
        return view('Web.User.bank.bank_details', compact('bankDetail'));
   }


   public function saveBankDetails(Request $request)
{
    $request->validate([
        'upi_id' => 'required|string',
        'account_holder_name' => 'required|string',
        'bank_name' => 'required|string',
        'branch_name' => 'required|string',
        'ifsc_code' => 'required|string',
        'account_number' => 'required|string',
        'status' => 'required|boolean',
        'barcode_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

  
    $bankDetail = BankDetail::where('user_id', $request->user_id)->first();

    if ($bankDetail) {
        
        $bankDetail->user_id = $request->user_id;
        $bankDetail->upi_id = $request->upi_id;
        $bankDetail->account_holder_name = $request->account_holder_name;
        $bankDetail->bank_name = $request->bank_name;
        $bankDetail->branch_name = $request->branch_name;
        $bankDetail->ifsc_code = $request->ifsc_code;
        $bankDetail->account_number = $request->account_number;
        $bankDetail->status = $request->status;

       
        if ($request->hasFile('barcode_image')) {
            $folderPath = 'uploads/user/profile';

           
            if ($bankDetail->barcode && \Storage::disk('public')->exists($bankDetail->barcode)) {
                \Storage::disk('public')->delete($bankDetail->barcode);
            }

         
            $imagePath = $request->file('barcode_image')->store($folderPath, 'public');
            $bankDetail->barcode = $imagePath; 
        }

        $bankDetail->save();

        return redirect()->back()->with('success', 'Bank details updated successfully!');
    } else {
       
        $bankDetail = new BankDetail();
        $bankDetail->user_id = $request->user_id;
        $bankDetail->upi_id = $request->upi_id;
        $bankDetail->account_holder_name = $request->account_holder_name;
        $bankDetail->bank_name = $request->bank_name;
        $bankDetail->branch_name = $request->branch_name;
        $bankDetail->ifsc_code = $request->ifsc_code;
        $bankDetail->account_number = $request->account_number;
        $bankDetail->status = $request->status;

        if ($request->hasFile('barcode_image')) {
            $folderPath = 'uploads/user/profile';

            $imagePath = $request->file('barcode_image')->store($folderPath, 'public');
            $bankDetail->barcode = $imagePath; 
        }
        $bankDetail->save();

        return redirect()->back()->with('success', 'Bank details added successfully!');
    }
}



   public function reports(){
        return view('Web.User.reports');
   }

   public function paymentStatus(){
    echo 1020;die;
   }
}
