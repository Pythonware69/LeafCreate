@extends('layouts.templatemap')

@section('styles')
    {{--Leagflet CSS and JS--}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #map {
            height: calc(100vh - 60px);
            width: 100%;
            position: relative;
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
                            name="description" rows="3" placeholder="Enter polyline
                            description" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry_polyline" class="form-label">
                            Polyline Geometry</label>
                            <textarea class="form-control" id="geometry_polyline" readonly
                            name="geometry_polyline" rows="3" placeholder="Enter polyline geometry">{{ old
                            ('geometry_polyline') }}</textarea>
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
                    <div class="modal-body
                    ">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <
                                ul class="mb-0">
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
        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        {{-- Leaflet JS --}}
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        {{-- Leaflet Draw JS --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
        {{-- Terraformer JS --}}
        <script src="https://cdn.jsdelivr.net/npm/terraformer@1.0.8/terraformer.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/terraformer-wkt-parser@1.2.1/terraformer-wkt-parser.min.js"></script>
        {{-- JQuery JS --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Initialize map centered on Jakarta
        const map = L.map('map').setView([-6.2088, 106.8456], 12);

        // Add OpenStreetMap basemap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19,
            minZoom: 2
        }).addTo(map);

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

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


    </script>
@endsection
