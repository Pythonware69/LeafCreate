<?php

namespace App\Http\Controllers;

use App\Models\pointsModel;
use App\Models\polylinesModel;
use App\Models\polygonsModel;

class PageController extends Controller
{
    protected pointsModel $points;
    protected polylinesModel $polylines;
    protected polygonsModel $polygons;
    public function __construct()
    {
        $this->points = new pointsModel();
        $this->polylines = new polylinesModel();
        $this->polygons = new polygonsModel();
    }
    public function landingpage()
    {
        $data = [
            'title' => 'Welkam',
            'pointsCount' => $this->points->count(),
            'polylinesCount' => $this->polylines->count(),
            'polygonsCount' => $this->polygons->count(),
        ];

        return view('home', $data);
    }

    public function peta()
    {
        $data = [
            'title' => 'Peta Jakarta',
        ];
        return view('map', $data);
    }

    public function tabel()
    {
        $data = [
            'title' => 'Tabel Data',
            'points' => $this->points->all(),
            'polylines' => $this->polylines->all(),
            'polygons' => $this->polygons->all(),
        ];
        return view('table', $data);
    }
}
