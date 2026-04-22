<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pointsModel extends Model
{
    protected $table = 'points';
    protected $fillable = ['geom', 'name', 'description', 'image'];
    public function geojson_points()
    {
        $points = $this->select(DB::raw('id, ST_AsGeoJSON(geom) as geom, name, description, image,
        created_at, updated_at'))->get();

        $features = [];
        foreach ($points as $point) {
            $features[] = [
                'type' => 'Feature',
                'geometry' => json_decode($point->geom),
                'properties' => [
                    'id' => $point->id,
                    'name' => $point->name,
                    'description' => $point->description,
                    'image' => $point->image,
                    'created_at' => $point->created_at,
                    'updated_at' => $point->updated_at
                ]
            ];
        }

        return [
            'type' => 'FeatureCollection',
            'features' => $features
        ];
    }
}
