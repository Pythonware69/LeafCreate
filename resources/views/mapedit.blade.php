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

    {{-- Modal Point Input --}}
    <div class="modal fade" tabindex="-1" id="modalInputPoint">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="point-modal-title">Input Point</h5>
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
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter point name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Point Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter point description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry_point" class="form-label">Point Geometry</label>
                            <textarea class="form-control" id="geometry_point" readonly name="geometry_point" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Point Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
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
                    <h5 class="modal-title" id="polyline-modal-title">Input Polyline</h5>
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
                            <input type="text" class="form-control" id="name-polyline" name="name" placeholder="Enter polyline name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description-polyline" class="form-label">Polyline Description</label>
                            <textarea class="form-control" id="description-polyline" name="description" rows="3" placeholder="Enter polyline description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry-polyline" class="form-label">Polyline Geometry</label>
                            <textarea class="form-control" id="geometry-polyline" readonly name="geometry_polyline" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image-polyline" class="form-label">Polyline Image</label>
                            <input type="file" class="form-control" id="image-polyline" name="image" accept="image/*" onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
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

    <div class="modal fade" tabindex="-1" id="modalInputPolygon">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="polygon-modal-title">Input Polygon</h5>
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
                            <input type="text" class="form-control" id="name-polygon" name="name" placeholder="Enter polygon name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description-polygon" class="form-label">Polygon Description</label>
                            <textarea class="form-control" id="description-polygon" name="description" rows="3" placeholder="Enter polygon description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry-polygon" class="form-label">Polygon Geometry</label>
                            <textarea class="form-control" id="geometry-polygon" readonly name="geometry_polygon" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image-polygon" class="form-label">Polygon Image</label>
                            <input type="file" class="form-control" id="image-polygon" name="image" accept="image/*" onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/terraformer@1.0.8/terraformer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/terraformer-wkt-parser@1.2.1/terraformer-wkt-parser.min.js"></script>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let tempCreatedLayer = null;

        function buildPopupContent(feature) {
            const name = feature.properties.name || 'No name';
            const description = feature.properties.description || '';
            const image = feature.properties.image ? '/storage/images/' + feature.properties.image : null;
            const id = feature.properties.id;
            const type = feature.properties.type || '';
            let popupContent = '<strong>' + name + '</strong><br>' + description;
            if (image) {
                popupContent += '<br><img src="' + image + '" style="width:100%; max-width:250px; height:auto; margin-top:8px;">';
            }
            if (id) {
                const editUrl = '{{ route('mapedit') }}?type=' + type + '&id=' + id;
                popupContent += '<br><div style="display:flex; gap:5px; margin-top:8px;">';
                popupContent += '<a class="btn btn-sm btn-primary" href="' + editUrl + '">Map Edit</a>';
                popupContent += '<button class="btn btn-sm btn-warning" onclick="editGeometryRecord(\'' + type + '\',' + id + ')">Edit</button>';
                popupContent += '<button class="btn btn-sm btn-danger" onclick="deleteGeometryRecord(\'' + type + '\',' + id + ')">Delete</button>';
                popupContent += '</div>';
            }
            return popupContent;
        }

        function editGeometryRecord(type, id) {
            if (type === 'point') {
                editPoint(id);
            } else if (type === 'polyline') {
                editPolyline(id);
            } else if (type === 'polygon') {
                editPolygon(id);
            }
        }

        function deleteGeometryRecord(type, id) {
            let url = '';
            if (type === 'point') url = '/destroy-points/' + id;
            if (type === 'polyline') url = '/destroy-polylines/' + id;
            if (type === 'polygon') url = '/destroy-polygons/' + id;
            if (!url) return;
            if (!confirm('Are you sure you want to delete this record?')) return;
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Deleted successfully');
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to delete');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Delete request failed');
            });
        }

        async function submitEditUpdate(route, body) {
            body.append('_method', 'PUT');
            body.append('_token', csrfToken);
            const response = await fetch(route, {
                method: 'POST',
                body: body
            });
            return response.json();
        }

        async function updateFeatureGeometry(layer) {
            const feature = layer.feature;
            const id = feature?.properties?.id;
            const type = feature?.properties?.type;
            const name = feature?.properties?.name || '';
            const description = feature?.properties?.description || '';
            const geometry = Terraformer.WKT.convert(layer.toGeoJSON().geometry);
            if (!id || !type) {
                return;
            }
            let route = '';
            let geomField = '';
            if (type === 'point') {
                route = '/update-points/' + id;
                geomField = 'geometry_point';
            } else if (type === 'polyline') {
                route = '/update-polylines/' + id;
                geomField = 'geometry_polyline';
            } else if (type === 'polygon') {
                route = '/update-polygons/' + id;
                geomField = 'geometry_polygon';
            }
            const body = new FormData();
            body.append('name', name);
            body.append('description', description);
            body.append(geomField, geometry);
            const result = await submitEditUpdate(route, body);
            if (result.success || result.status === 'success') {
                return true;
            }
            return false;
        }

        function editPoint(id) {
            fetch('/api/points')
                .then(response => response.json())
                .then(data => {
                    const feature = data.data.features.find(f => f.properties.id == id);
                    if (!feature) return;
                    document.getElementById('point-id').value = id;
                    document.getElementById('point-modal-title').textContent = 'Edit Point';
                    document.getElementById('name').value = feature.properties.name || '';
                    document.getElementById('description').value = feature.properties.description || '';
                    document.getElementById('geometry_point').value = Terraformer.WKT.convert(feature.geometry);
                    const form = document.getElementById('formPoint');
                    form.action = '/update-points/' + id;
                    document.getElementById('point-method').innerHTML = '<input type="hidden" name="_method" value="PUT">';
                    new bootstrap.Modal(document.getElementById('modalInputPoint')).show();
                })
                .catch(error => console.error('Error fetching point:', error));
        }

        function editPolyline(id) {
            fetch('/api/polylines')
                .then(response => response.json())
                .then(data => {
                    const feature = data.data.features.find(f => f.properties.id == id);
                    if (!feature) return;
                    document.getElementById('polyline-id').value = id;
                    document.getElementById('polyline-modal-title').textContent = 'Edit Polyline';
                    document.getElementById('name-polyline').value = feature.properties.name || '';
                    document.getElementById('description-polyline').value = feature.properties.description || '';
                    document.getElementById('geometry-polyline').value = Terraformer.WKT.convert(feature.geometry);
                    const form = document.getElementById('formPolyline');
                    form.action = '/update-polylines/' + id;
                    document.getElementById('polyline-method').innerHTML = '<input type="hidden" name="_method" value="PUT">';
                    new bootstrap.Modal(document.getElementById('modalInputPolyline')).show();
                })
                .catch(error => console.error('Error fetching polyline:', error));
        }

        function editPolygon(id) {
            fetch('/api/polygons')
                .then(response => response.json())
                .then(data => {
                    const feature = data.data.features.find(f => f.properties.id == id);
                    if (!feature) return;
                    document.getElementById('polygon-id').value = id;
                    document.getElementById('polygon-modal-title').textContent = 'Edit Polygon';
                    document.getElementById('name-polygon').value = feature.properties.name || '';
                    document.getElementById('description-polygon').value = feature.properties.description || '';
                    document.getElementById('geometry-polygon').value = Terraformer.WKT.convert(feature.geometry);
                    const form = document.getElementById('formPolygon');
                    form.action = '/update-polygons/' + id;
                    document.getElementById('polygon-method').innerHTML = '<input type="hidden" name="_method" value="PUT">';
                    new bootstrap.Modal(document.getElementById('modalInputPolygon')).show();
                })
                .catch(error => console.error('Error fetching polygon:', error));
        }

        document.addEventListener('DOMContentLoaded', async function() {
            const map = L.map('map').setView([-6.2088, 106.8456], 12);
            const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
                minZoom: 2
            }).addTo(map);

            const drawnItems = new L.FeatureGroup();
            map.addLayer(drawnItems);

            async function loadSavedLayers() {
                try {
                    const pointsRes = await fetch('/api/points');
                    const pointsData = await pointsRes.json();
                    if (pointsData.status === 'success') {
                        L.geoJSON(pointsData.data, {
                            pointToLayer: function(feature, latlng) {
                                return L.marker(latlng);
                            },
                            onEachFeature: function(feature, layer) {
                                feature.properties.type = 'point';
                                layer.bindPopup(buildPopupContent(feature), { maxWidth: 280, maxHeight: 400 });
                                layer.feature = feature;
                                drawnItems.addLayer(layer);
                            }
                        });
                    }

                    const polylinesRes = await fetch('/api/polylines');
                    const polylinesData = await polylinesRes.json();
                    if (polylinesData.status === 'success') {
                        L.geoJSON(polylinesData.data, {
                            onEachFeature: function(feature, layer) {
                                feature.properties.type = 'polyline';
                                layer.bindPopup(buildPopupContent(feature), { maxWidth: 280, maxHeight: 400 });
                                layer.feature = feature;
                                drawnItems.addLayer(layer);
                            }
                        });
                    }

                    const polygonsRes = await fetch('/api/polygons');
                    const polygonsData = await polygonsRes.json();
                    if (polygonsData.status === 'success') {
                        L.geoJSON(polygonsData.data, {
                            onEachFeature: function(feature, layer) {
                                feature.properties.type = 'polygon';
                                layer.bindPopup(buildPopupContent(feature), { maxWidth: 280, maxHeight: 400 });
                                layer.feature = feature;
                                drawnItems.addLayer(layer);
                            }
                        });
                    }
                } catch (error) {
                    console.error('Error loading saved features:', error);
                }
            }

            await loadSavedLayers();

            const drawControl = new L.Control.Draw({
                draw: {
                    position: 'topleft',
                    polyline: true,
                    polygon: true,
                    rectangle: true,
                    circle: false,
                    marker: true,
                    circlemarker: false
                },
                edit: {
                    featureGroup: drawnItems,
                    remove: true
                }
            });
            map.addControl(drawControl);

            map.on('draw:created', function(e) {
                const type = e.layerType;
                const layer = e.layer;
                const geoJson = layer.toGeoJSON();
                const objectGeometry = Terraformer.WKT.convert(geoJson.geometry);
                tempCreatedLayer = layer;
                drawnItems.addLayer(layer);

                if (type === 'marker') {
                    document.getElementById('formPoint').action = '/store-points';
                    document.getElementById('point-method').innerHTML = '';
                    document.getElementById('point-modal-title').textContent = 'Input Point';
                    document.getElementById('geometry_point').value = objectGeometry;
                    new bootstrap.Modal(document.getElementById('modalInputPoint')).show();
                } else if (type === 'polyline') {
                    document.getElementById('formPolyline').action = '/store-polylines';
                    document.getElementById('polyline-method').innerHTML = '';
                    document.getElementById('polyline-modal-title').textContent = 'Input Polyline';
                    document.getElementById('geometry-polyline').value = objectGeometry;
                    new bootstrap.Modal(document.getElementById('modalInputPolyline')).show();
                } else if (type === 'polygon' || type === 'rectangle') {
                    document.getElementById('formPolygon').action = '/store-polygons';
                    document.getElementById('polygon-method').innerHTML = '';
                    document.getElementById('polygon-modal-title').textContent = 'Input Polygon';
                    document.getElementById('geometry-polygon').value = objectGeometry;
                    new bootstrap.Modal(document.getElementById('modalInputPolygon')).show();
                }

                const currentModal = document.querySelector('.modal.show');
                if (currentModal) {
                    currentModal.addEventListener('hidden.bs.modal', function () {
                        if (tempCreatedLayer && drawnItems.hasLayer(tempCreatedLayer)) {
                            drawnItems.removeLayer(tempCreatedLayer);
                        }
                        tempCreatedLayer = null;
                    }, { once: true });
                }
            });

            map.on('draw:edited', async function(e) {
                let successful = true;
                for (const layer of e.layers.getLayers()) {
                    const updated = await updateFeatureGeometry(layer);
                    if (!updated) {
                        successful = false;
                    }
                }
                if (successful) {
                    alert('Geometry updated successfully');
                    window.location.reload();
                } else {
                    alert('One or more updates failed');
                }
            });

            map.on('draw:deleted', function(e) {
                e.layers.eachLayer(function(layer) {
                    const id = layer.feature?.properties?.id;
                    const type = layer.feature?.properties?.type;
                    if (!id || !type) {
                        return;
                    }
                    deleteGeometryRecord(type, id);
                });
            });
        });
    </script>
@endsection
