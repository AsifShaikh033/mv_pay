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
   public function reports(){
        return view('Web.User.reports');
   }
}
