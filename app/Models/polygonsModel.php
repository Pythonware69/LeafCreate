<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class polygonsModel extends Model
{
    protected $table = 'polygons';
    protected $guarded = ['id'];

    public function geojson_polygons()
{
    $polygons = $this->select(DB::raw('id, ST_AsGeoJSON(geom) as geom, name, description, image, created_at, updated_at'))->get();

    $features = [];
    foreach ($polygons as $polygon) {
        $features[] = [
            'type' => 'Feature',
            'geometry' => json_decode($polygon->geom),
            'properties' => [
                'id' => $polygon->id,
                'name' => $polygon->name,
                'description' => $polygon->description,
                'image' => $polygon->image,
                'created_at' => $polygon->created_at,
                'updated_at' => $polygon->updated_at
            ]
        ];
    }

    return [
        'type' => 'FeatureCollection',
        'features' => $features
    ];
}
}
