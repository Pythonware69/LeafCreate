<?php

namespace App\Http\Controllers;

use App\Models\pointsModel;
use App\Models\polygonsModel;
use App\Models\polylinesModel;
use Illuminate\Http\Request;

class apiController extends Controller
{
    protected $points;
    protected $polylines;
    protected $polygons;

    public function __construct()
    {
        $this->points = new pointsModel();
        $this->polylines = new polylinesModel();
        $this->polygons = new polygonsModel();
    }

    public function points()
    {
        $points = $this->points->geojson_points();

        return response()->json([
            'status'  => 'success',
            'message' => 'Points retrieved successfully',
            'data'    => $points
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function polylines()
    {
        $polylines = $this->polylines->geojson_polylines();

        return response()->json([
            'status'  => 'success',
            'message' => 'Polylines retrieved successfully',
            'data'    => $polylines
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function polygons()
    {
        $polygons = $this->polygons->geojson_polygons();

        return response()->json([
            'status'  => 'success',
            'message' => 'Polygons retrieved successfully',
            'data'    => $polygons
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}
