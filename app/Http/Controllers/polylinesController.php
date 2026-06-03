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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        //get image from request and save to storage/images directory with unique name and get the name of the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $validated['geometry_polyline'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $name_image,
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
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:5|max:1000',
            'geometry_polyline' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the polyline to update
        $polyline = $this->polylines->find($id);
        if (!$polyline) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
            }
            return redirect()->route('peta')->with('error', 'Data tidak ditemukan');
        }

        // Handle image upload
        $name_image = $polyline->image; // Keep existing image by default
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($polyline->image && file_exists('storage/images/' . $polyline->image)) {
                unlink('storage/images/' . $polyline->image);
            }
            // Save new image
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        }

        $data = [
            'geom' => $validated['geometry_polyline'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $name_image,
        ];

        // Update data to database
        if ($polyline->update($data)) {
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui']);
            }
            return redirect()->route('peta')->with('success', 'Data berhasil diperbarui');
        } else {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Data gagal diperbarui'], 500);
            }
            return redirect()->route('peta')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $polyline = $this->polylines->find($id);
        if ($polyline) {
            // Delete image if it exists
            if ($polyline->image && file_exists('storage/images/' . $polyline->image)) {
                unlink('storage/images/' . $polyline->image);
            }
            $polyline->delete();
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
        }
        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);

        dd($id);
    }
}
