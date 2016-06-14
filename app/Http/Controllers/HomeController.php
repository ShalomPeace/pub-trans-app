<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\StationRepositoryInterface;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{   
    /**
     * Displays index page
     * 
     * @param  \App\Repositories\Contracts\StationRepositoryInterface $stationRepository [description]
     * @return \Illuminate\Http\Response
     */
    public function index(StationRepositoryInterface $stationRepository)
    {
        $stations = $stationRepository->getForField();

        return view('home.index', ['stations' => $stations]);
    }
}
