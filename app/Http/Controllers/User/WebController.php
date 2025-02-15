<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebConfig;
use App\Models\Bankdetail;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

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
    // Validate incoming data
    $request->validate([
        'upi_id' => 'required|string',
        // 'account_holder_name' => 'required|string',
        // 'bank_name' => 'required|string',
        // 'branch_name' => 'required|string',
        // 'ifsc_code' => 'required|string',
        // 'account_number' => 'required|string',
        'status' => 'required|boolean',
        'barcode_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Check if bank details already exist for this user_id
    $bankDetail = BankDetail::where('user_id', $request->user_id)->first();

    if ($bankDetail) {
        // Update existing record
        $bankDetail->user_id = $request->user_id;
        $bankDetail->upi_id = $request->upi_id;
        // $bankDetail->account_holder_name = $request->account_holder_name;
        // $bankDetail->bank_name = $request->bank_name;
        // $bankDetail->branch_name = $request->branch_name;
        // $bankDetail->ifsc_code = $request->ifsc_code;
        // $bankDetail->account_number = $request->account_number;
        $bankDetail->status = $request->status;

        if ($request->hasFile('barcode_image')) {

            if (!Storage::exists('public/barcodes')) {
                Storage::makeDirectory('public/barcodes');
            }
           
            if ($bankDetail->barcode && \Storage::disk('public')->exists('barcodes/' . $bankDetail->barcode)) {
                \Storage::disk('public')->delete('barcodes/' . $bankDetail->barcode);
    
            }

            // Save the new barcode image in the 'public/barcodes' folder
            $image = $request->file('barcode_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/barcodes', $imageName);
            $bankDetail->barcode = $imageName;
        }

        $bankDetail->save();

        return redirect()->back()->with('success', 'Bank details updated successfully!');
    } else {
        // Insert new record
        $bankDetail = new BankDetail();
        $bankDetail->user_id = $request->user_id;
        $bankDetail->upi_id = $request->upi_id;
        // $bankDetail->account_holder_name = $request->account_holder_name;
        // $bankDetail->bank_name = $request->bank_name;
        // $bankDetail->branch_name = $request->branch_name;
        // $bankDetail->ifsc_code = $request->ifsc_code;
        // $bankDetail->account_number = $request->account_number;
        $bankDetail->status = $request->status;

        // Handle file upload if a file is provided
        if ($request->hasFile('barcode_image')) {
            $barcode = $request->file('barcode_image');
            $imageName = time() . '.' . $barcode->getClientOriginalExtension();
            $barcode->storeAs('public/barcodes', $imageName);
            $bankDetail->barcode = $imageName;
        }
        
        

        $bankDetail->save();

        return redirect()->back()->with('success', 'Bank details added successfully!');
    }
}



   public function reports(){
        return view('Web.User.reports');
   }
}
