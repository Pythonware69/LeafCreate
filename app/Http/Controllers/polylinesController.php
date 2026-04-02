<?php

namespace App\Http\Controllers;

use App\Models\polylinesModel;
use Illuminate\Http\Request;

class polylinesController extends Controller
{
    protected $polylines;

    public function __construct()
    {
        $this->polylines = new polylinesModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:5|max:1000',
            'geometry_polyline' => 'required|string',
        ]);

        $data = [
            'geom' => $validated['geometry_polyline'],
            'name' => $validated['name'],
            'description' => $validated['description'],
        ];

        //save data to database and return to map page with success message
        $this->polylines->create($data);
        return redirect()->route('peta')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
