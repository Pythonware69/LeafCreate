<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class polylinesModel extends Model
{
    protected $table = 'polylines';
    protected $fillable = ['geom', 'name', 'description', 'image'];

    public function geojson_polylines()
    {
        $polylines = $this->select(DB::raw('id, ST_AsGeoJSON(geom) as geom, name, description, image, created_at, updated_at'))->get();

        $features = [];
        foreach ($polylines as $polyline) {
            $features[] = [
                'type' => 'Feature',
                'geometry' => json_decode($polyline->geom),
                'properties' => [
                    'id' => $polyline->id,
                    'name' => $polyline->name,
                    'description' => $polyline->description,
                    'image' => $polyline->image ?? null,
                    'created_at' => $polyline->created_at,
                    'updated_at' => $polyline->updated_at
                ]
            ];
        }

        return [
            'type' => 'FeatureCollection',
            'features' => $features
        ];
    }
}
