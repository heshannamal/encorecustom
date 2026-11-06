<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifestylePageController extends Controller
{
    public function lifestyle_page(){

        return view('pages/customer_end/lifestyle_page/index');
    }
}
