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
                    <h5 class="modal-title" id="point-modal-title">Input Point </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formPoint" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="point-id" name="id">
                    <div id="point-method"></div>
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
                        <div class="mb-3">
                            <label for="image"
                            class="form-label">Point Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*"
                            onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                            <img id="preview-image-point" style="margin-top: 10px; max-width: 100%; max-height: 300px;" />
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


    <div class="modal fade" tabindex="-1" id="modalInputPolyline">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="polyline-modal-title">Input Polyline </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formPolyline" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="polyline-id" name="id">
                    <div id="polyline-method"></div>
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
                            <label for="name-polyline" class="form-label">Polyline Name</label>
                            <input type="text" class="form-control" id="name-polyline"
                            name="name" placeholder="Enter polyline name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description-polyline" class="form-label">Polyline Description</label>
                            <textarea class="form-control" id="description-polyline"
                            name="description" rows="3" placeholder="Enter polyline description" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry-polyline" class="form-label">
                            Polyline Geometry</label>
                            <textarea class="form-control" id="geometry-polyline" readonly
                            name="geometry_polyline" rows="3" placeholder="Enter polyline geometry">{{ old('geometry_polyline') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image-polyline"
                            class="form-label">Polyline Image</label>
                            <input type="file" class="form-control" id="image-polyline" name="image" accept="image/*"
                            onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                            <img id="preview-image-polyline" style="margin-top: 10px; max-width: 100%; max-height: 300px;" />
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
                    <h5 class="modal-title" id="polygon-modal-title">Input Polygon </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formPolygon" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="polygon-id" name="id">
                    <div id="polygon-method"></div>
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
                            <label for="name-polygon" class="form-label">Polygon Name</label>
                            <input type="text" class="form-control" id="name-polygon"
                            name="name" placeholder="Enter polygon name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description-polygon" class="form-label">Polygon Description</label>
                            <textarea class="form-control" id="description-polygon"
                            name="description" rows="3" placeholder="Enter polygon description" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry-polygon" class="form-label">Polygon Geometry</label>
                            <textarea class="form-control" id="geometry-polygon" readonly
                            name="geometry_polygon" rows="3" placeholder="Enter polygon geometry">{{ old('geometry_polygon') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image-polygon"
                            class="form-label">Polygon Image</label>
                            <input type="file" class="form-control" id="image-polygon" name="image" accept="image/*"
                            onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                            <img id="preview-image-polygon" style="margin-top: 10px; max-width: 100%; max-height: 300px;" />
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
        // Delete functions - GLOBAL SCOPE
        function deletePoint(id) {
            if (confirm('Are you sure you want to delete this point?')) {
                fetch('/destroy-points/' + id, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Delete failed: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert('Point deleted successfully');
                        window.location.reload();
                    } else {
                        alert('Error: ' + (data.message || 'Failed to delete point'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting point: ' + error.message);
                });
            }
        }

        function deletePolyline(id) {
            if (confirm('Are you sure you want to delete this polyline?')) {
                fetch('/destroy-polylines/' + id, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Delete failed: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert('Polyline deleted successfully');
                        window.location.reload();
                    } else {
                        alert('Error: ' + (data.message || 'Failed to delete polyline'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting polyline: ' + error.message);
                });
            }
        }

        function deletePolygon(id) {
            if (confirm('Are you sure you want to delete this polygon?')) {
                fetch('/destroy-polygons/' + id, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Delete failed: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert('Polygon deleted successfully');
                        window.location.reload();
                    } else {
                        alert('Error: ' + (data.message || 'Failed to delete polygon'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting polygon: ' + error.message);
                });
            }
        }

        // Edit functions
        function editPoint(id) {
            // Fetch point data
            fetch('/api/points')
                .then(response => response.json())
                .then(data => {
                    const point = data.data.features.find(f => f.properties.id == id);
                    if (point) {
                        document.getElementById('point-id').value = id;
                        document.getElementById('point-modal-title').textContent = 'Edit Point';
                        document.getElementById('name').value = point.properties.name || '';
                        document.getElementById('description').value = point.properties.description || '';
                        document.getElementById('geometry_point').value = Terraformer.WKT.convert(point.geometry);

                        // Set form action to update route
                        const form = document.getElementById('formPoint');
                        form.action = '/update-points/' + id;

                        // Add PUT method (Laravel uses _method field)
                        const methodDiv = document.getElementById('point-method');
                        methodDiv.innerHTML = '<input type="hidden" name="_method" value="PUT">';

                        // Show modal for editing
                        const modal = new bootstrap.Modal(document.getElementById('modalInputPoint'));
                        modal.show();
                    }
                })
                .catch(error => console.error('Error fetching point:', error));
        }

        function editPolyline(id) {
            // Fetch polyline data
            fetch('/api/polylines')
                .then(response => response.json())
                .then(data => {
                    const polyline = data.data.features.find(f => f.properties.id == id);
                    if (polyline) {
                        document.getElementById('polyline-id').value = id;
                        document.getElementById('polyline-modal-title').textContent = 'Edit Polyline';
                        document.getElementById('name-polyline').value = polyline.properties.name || '';
                        document.getElementById('description-polyline').value = polyline.properties.description || '';
                        document.getElementById('geometry-polyline').value = Terraformer.WKT.convert(polyline.geometry);

                        // Set form action to update route
                        const form = document.getElementById('formPolyline');
                        form.action = '/update-polylines/' + id;

                        // Add PUT method (Laravel uses _method field)
                        const methodDiv = document.getElementById('polyline-method');
                        methodDiv.innerHTML = '<input type="hidden" name="_method" value="PUT">';

                        // Show modal for editing
                        const modal = new bootstrap.Modal(document.getElementById('modalInputPolyline'));
                        modal.show();
                    }
                })
                .catch(error => console.error('Error fetching polyline:', error));
        }

        function editPolygon(id) {
            // Fetch polygon data
            fetch('/api/polygons')
                .then(response => response.json())
                .then(data => {
                    const polygon = data.data.features.find(f => f.properties.id == id);
                    if (polygon) {
                        document.getElementById('polygon-id').value = id;
                        document.getElementById('polygon-modal-title').textContent = 'Edit Polygon';
                        document.getElementById('name-polygon').value = polygon.properties.name || '';
                        document.getElementById('description-polygon').value = polygon.properties.description || '';
                        document.getElementById('geometry-polygon').value = Terraformer.WKT.convert(polygon.geometry);

                        // Set form action to update route
                        const form = document.getElementById('formPolygon');
                        form.action = '/update-polygons/' + id;

                        // Add PUT method (Laravel uses _method field)
                        const methodDiv = document.getElementById('polygon-method');
                        methodDiv.innerHTML = '<input type="hidden" name="_method" value="PUT">';

                        // Show modal for editing
                        const modal = new bootstrap.Modal(document.getElementById('modalInputPolygon'));
                        modal.show();
                    }
                })
                .catch(error => console.error('Error fetching polygon:', error));
        }

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
                    let popupContent = feature.properties.name + '<br>' + (feature.properties.description || '');
                    if (feature.properties.image) {
                      const imageUrl = '/storage/images/' + feature.properties.image;
                      popupContent += '<br><img src="' + imageUrl + '" style="width:100%; max-width:250px; height:auto; margin-top:8px;">';
                    }
                    popupContent += '<br><div style="display: flex; gap: 5px; margin-top: 8px;"><a class="btn btn-sm btn-primary" href="{{ route('mapedit') }}?type=point&id=' + feature.properties.id + '">Map Edit</a><button class="btn btn-sm btn-warning" onclick="editPoint(' + feature.properties.id + ')">Edit</button><button class="btn btn-sm btn-danger" onclick="deletePoint(' + feature.properties.id + ')">Delete</button></div>';
                    layer.bindPopup(popupContent, { maxWidth: 280, maxHeight: 400 });
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
                    let popupContent = feature.properties.name + '<br>' + (feature.properties.description || '');
                    if (feature.properties.image) {
                      const imageUrl = '/storage/images/' + feature.properties.image;
                      popupContent += '<br><img src="' + imageUrl + '" style="width:100%; max-width:250px; height:auto; margin-top:8px;">';
                    }
                    popupContent += '<br><div style="display: flex; gap: 5px; margin-top: 8px;"><a class="btn btn-sm btn-primary" href="{{ route('mapedit') }}?type=polyline&id=' + feature.properties.id + '">Map Edit</a><button class="btn btn-sm btn-warning" onclick="editPolyline(' + feature.properties.id + ')">Edit</button><button class="btn btn-sm btn-danger" onclick="deletePolyline(' + feature.properties.id + ')">Delete</button></div>';
                    layer.bindPopup(popupContent, { maxWidth: 280, maxHeight: 400 });
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
                    let popupContent = feature.properties.name + '<br>' + (feature.properties.description || '');
                    if (feature.properties.image) {
                      const imageUrl = '/storage/images/' + feature.properties.image;
                      popupContent += '<br><img src="' + imageUrl + '" style="width:100%; max-width:250px; height:auto; margin-top:8px;">';
                    }
                    popupContent += '<br><div style="display: flex; gap: 5px; margin-top: 8px;"><a class="btn btn-sm btn-primary" href="{{ route('mapedit') }}?type=polygon&id=' + feature.properties.id + '">Map Edit</a><button class="btn btn-sm btn-warning" onclick="editPolygon(' + feature.properties.id + ')">Edit</button><button class="btn btn-sm btn-danger" onclick="deletePolygon(' + feature.properties.id + ')">Delete</button></div>';
                    layer.bindPopup(popupContent, { maxWidth: 280, maxHeight: 400 });
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
                // Set form for create
                document.getElementById('formPoint').action = '/store-points';
                document.getElementById('point-method').innerHTML = '';
                document.getElementById('point-modal-title').textContent = 'Input Point';
                document.getElementById('point-id').value = '';

                $('#geometry_point').val(objectGeometry);
                $('#modalInputPoint').modal('show');
                $('#modalInputPoint').on('hidden.bs.modal', function () {
                    window.location.reload();
                });

            } else if (type === 'polyline') {
                // Set form for create
                document.getElementById('formPolyline').action = '/store-polylines';
                document.getElementById('polyline-method').innerHTML = '';
                document.getElementById('polyline-modal-title').textContent = 'Input Polyline';
                document.getElementById('polyline-id').value = '';

                $('#geometry-polyline').val(objectGeometry);
                $('#modalInputPolyline').modal('show');
                $('#modalInputPolyline').on('hidden.bs.modal', function () {
                    window.location.reload();
                });

            } else if (type === 'polygon' || type === 'rectangle') {
                // Set form for create
                document.getElementById('formPolygon').action = '/store-polygons';
                document.getElementById('polygon-method').innerHTML = '';
                document.getElementById('polygon-modal-title').textContent = 'Input Polygon';
                document.getElementById('polygon-id').value = '';

                $('#geometry-polygon').val(objectGeometry);
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

