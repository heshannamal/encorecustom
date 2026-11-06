<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerEndController extends Controller
{
    public function encorecustom_com(){

        return view('pages/customer_end/home_page/index');
    }
}
