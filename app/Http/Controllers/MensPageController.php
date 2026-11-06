<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MensPageController extends Controller
{
    public function mens_page(){

        return view('pages/customer_end/mens_page/index');
    }

    public function mens_top_page(){

        return view('pages/customer_end/mens_page/top_page/index');
    }
    public function mens_bottom_page(){

        return view('pages/customer_end/mens_page/bottom_page/index');
    }
    public function mens_accessories_page(){

        return view('pages/customer_end/mens_page/accessories_page/index');
    }
}
