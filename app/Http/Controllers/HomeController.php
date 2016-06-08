<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\StationRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StationRepositoryInterface $stationRepository)
    {
        $stations = $stationRepository->getForField();

        return view('home.index', ['stations' => $stations]);
    }
}
