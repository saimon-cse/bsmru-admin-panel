<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StuffController extends Controller
{

    //
    // public function StuffDashboard(){
    //     return view ('stuff.dashboard');
    // }

    public function generateHash(Request $request)
    {
        $text = $request->input('text');
        $hash = Hash::make($text);
        return response()->json(['hash' => $hash]);
    }
}

