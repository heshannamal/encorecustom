<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomApparelController extends Controller
{
    public function custom_apparel(){

        return view('pages/customer_end/custom_apparel/index');
    }
    public function design_concept(){

        return view('pages/customer_end/custom_apparel/design_concept');
    }
}
