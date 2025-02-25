<?php

namespace App\Http\Controllers;

use App\Models\LeadGeneration;
use App\Models\user;
use Illuminate\Http\Request;

class LeadGenerationController extends Controller
{
    /**
     * Show a list of all lead generation records.
     *
     * @return \Illuminate\View\View
     */
 
     public function index()
     {
         $leadGenerations = LeadGeneration::with('user')->orderBy('created_at', 'desc')->get();
     
         return view('Admin.lead_generation.index', compact('leadGenerations'));
     }
     

}
