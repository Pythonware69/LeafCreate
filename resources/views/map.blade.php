@extends('layouts.templatemap')

@section('styles')
    {{-- Leaflet Draw CSS only (Leaflet CSS in layout if needed) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        #map {
            height: 100vh;
            width: 100%;
            display: block !important;
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>

    {{--Modal Point Input--}}

    <div class="modal fade" tabindex="-1" id="modalInputPoint">
         <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Point </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('points.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="name" class="form-label">Point Name</label>
                            <input type="text" class="form-control" id="name"
                            name="name" placeholder="Enter point name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Point Description</label>
                            <textarea class="form-control" id="description"
                            name="description" rows="3" placeholder="Enter point description" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry_point" class="form-label">Point Geometry</label>
                            <textarea class="form-control" id="geometry_point" readonly
                            name="geometry_point" rows="3" placeholder="Enter point geometry">{{ old('geometry_point') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


{{--modal polyline input--}}
    <div class="modal fade" tabindex="-1" id="modalInputPolyline">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Polyline </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('polylines.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="name" class="form-label">Polyline Name</label>
                            <input type="text" class="form-control" id="name"
                            name="name" placeholder="Enter polyline name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Polyline Description</label>
                            <textarea class="form-control" id="description"
                            name="description" rows="3" placeholder="Enter polyline description" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry_polyline" class="form-label">
                            Polyline Geometry</label>
                            <textarea class="form-control" id="geometry_polyline" readonly
                            name="geometry_polyline" rows="3" placeholder="Enter polyline geometry">{{ old('geometry_polyline') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Polygon Input --}}
    <div class="modal fade" tabindex="-1" id="modalInputPolygon">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Polygon </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('polygons.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="name" class="form-label">Polygon Name</label>
                            <input type="text" class="form-control" id="name"
                            name="name" placeholder="Enter polygon name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Polygon Description</label>
                            <textarea class="form-control" id="description"
                            name="description" rows="3" placeholder="Enter polygon description" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry_polygon" class="form-label">Polygon Geometry</label>
                            <textarea class="form-control" id="geometry_polygon" readonly
                            name="geometry_polygon" rows="3" placeholder="Enter polygon geometry">{{ old('geometry_polygon') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




@section('scripts')
    <!-- Leaflet Draw JS (others in layout) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <!-- Terraformer -->
    <script src="https://cdn.jsdelivr.net/npm/terraformer@1.0.8/terraformer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/terraformer-wkt-parser@1.2.1/terraformer-wkt-parser.min.js"></script>

    <script>
        // Wait for DOM ready
        document.addEventListener('DOMContentLoaded', function() {
        // Initialize map centered on Jakarta
        const map = L.map('map').setView([-6.2088, 106.8456], 12);

        // Add OpenStreetMap basemap
        var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19,
            minZoom: 2
        }).addTo(map);

        /* Geometry Feature Layers */
        var pointsLayer = new L.FeatureGroup();
        var polylinesLayer = new L.FeatureGroup();
        var polygonsLayer = new L.FeatureGroup();
        var drawnItems = new L.FeatureGroup();

        map.addLayer(pointsLayer);
        map.addLayer(polylinesLayer);
        map.addLayer(polygonsLayer);
        map.addLayer(drawnItems);

        // Load saved data from API
        async function loadSavedLayers() {
          try {
            // Points
            const pointsRes = await fetch('/api/points');
            const pointsData = await pointsRes.json();
            if (pointsData.status === 'success' && pointsData.data.features.length > 0) {
              L.geoJSON(pointsData.data, {
                pointToLayer: function(feature, latlng) {
                  return L.marker(latlng);
                },
                onEachFeature: function(feature, layer) {
                  if (feature.properties.name) {
                    layer.bindPopup(feature.properties.name + '<br>' + (feature.properties.description || ''));
                  }
                }
              }).addTo(pointsLayer);
            }

            // Polylines
            const polylinesRes = await fetch('/api/polylines');
            const polylinesData = await polylinesRes.json();
            if (polylinesData.status === 'success' && polylinesData.data.features.length > 0) {
              L.geoJSON(polylinesData.data, {
                onEachFeature: function(feature, layer) {
                  if (feature.properties.name) {
                    layer.bindPopup(feature.properties.name + '<br>' + (feature.properties.description || ''));
                  }
                }
              }).addTo(polylinesLayer);
            }

            // Polygons
            const polygonsRes = await fetch('/api/polygons');
            const polygonsData = await polygonsRes.json();
            if (polygonsData.status === 'success' && polygonsData.data.features.length > 0) {
              L.geoJSON(polygonsData.data, {
                onEachFeature: function(feature, layer) {
                  if (feature.properties.name) {
                    layer.bindPopup(feature.properties.name + '<br>' + (feature.properties.description || ''));
                  }
                }
              }).addTo(polygonsLayer);
            }
          } catch (error) {
            console.error('Error loading saved layers:', error);
          }
        }

        // Load saved layers when map is ready
        map.whenReady(loadSavedLayers);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        // Add layer control for geometry features
        var layerControl = L.control.layers(
            { 'OpenStreetMap': osmLayer },
            {
                'Points': pointsLayer,
                'Polylines': polylinesLayer,
                'Polygons': polygonsLayer,
                'Drawn Items': drawnItems
            },
            { position: 'topright', collapsed: false }
        );
        map.addControl(layerControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.WKT.convert(drawnJSONObject.geometry);

            if (type === 'marker') {
                $('#geometry_point').val(objectGeometry);
                $('#modalInputPoint').modal('show');
                $('#modalInputPoint').on('hidden.bs.modal', function () {
                    window.location.reload();
                });

            } else if (type === 'polyline') {
                $('#geometry_polyline').val(objectGeometry);
                $('#modalInputPolyline').modal('show');
                $('#modalInputPolyline').on('hidden.bs.modal', function () {
                    window.location.reload();
                });

            } else if (type === 'polygon' || type === 'rectangle') {
                $('#geometry_polygon').val(objectGeometry);
                $('#modalInputPolygon').modal('show');
                $('#modalInputPolygon').on('hidden.bs.modal', function () {
                    window.location.reload();
                });
            }

            drawnItems.addLayer(layer);
        });
        });
    </script>
@endsection

