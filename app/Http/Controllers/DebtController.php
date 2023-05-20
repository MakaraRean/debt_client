<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function getDebt(Request $request){
        $url = getenv('DEBT_URL');
        return view('debt');
    }
}
