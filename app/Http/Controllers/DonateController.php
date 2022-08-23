<?php

namespace App\Http\Controllers;

use App\Models\cabalCash;
use App\Models\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonateController extends Controller
{
    //
    public function index()
    {
        $cash = cabalCash::where('ID', Auth::user()->ID)
                            ->where('UserNum', Auth::user()->UserNum)
                            ->first();

        $plans = Plans::where('status', '1')->get();

        return view('painel.pages.donate.index', compact('cash', 'plans'));
    }
}
