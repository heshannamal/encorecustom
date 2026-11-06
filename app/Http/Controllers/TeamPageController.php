<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamPageController extends Controller
{
    public function team_page(){

        return view('pages/customer_end/team_page/index');
    }
    public function soccer(){

        return view('pages/customer_end/soccer/index');
    }
    public function basketball(){

        return view('pages/customer_end/basketball/index');
    }
    public function volleyball(){

        return view('pages/customer_end/volleyball/index');
    }
    public function thai_mma(){

        return view('pages/customer_end/thai_mma/index');
    }
    public function baseball(){

        return view('pages/customer_end/baseball/index');
    }
    public function disc_golf(){

        return view('pages/customer_end/disc_golf/index');
    }
    public function water_sport(){

        return view('pages/customer_end/water_sport/index');
    }
    public function gym(){

        return view('pages/customer_end/gym/index');
    }
    public function yoga(){

        return view('pages/customer_end/yoga/index');
    }
}
