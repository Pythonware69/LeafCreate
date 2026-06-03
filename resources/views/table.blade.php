@extends('layouts.templatemap')

@section('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card">
        <div class="card-header">
            <h2>Things I Know</h2>
        </div>
        <div class="card-body">
            <div class="table-controls">
                <div class="search-control">
                    <label for="search">Search:</label>
                    <input type="text" id="search" placeholder="Search table...">
                </div>
            </div>

            <div class="data-section">
                <h3>Points</h3>
                <table class="table table-hover table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Date Added</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($points ?? [] as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                @if ($item->image)
                                    <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}" style="max-width:120px; max-height:80px; object-fit:contain;" />
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ optional($item->created_at)->format('Y-m-d') ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No points available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="data-section mt-5">
                <h3>Polylines</h3>
                <table class="table table-hover table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Date Added</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($polylines ?? [] as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                @if ($item->image)
                                    <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}" style="max-width:120px; max-height:80px; object-fit:contain;" />
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ optional($item->created_at)->format('Y-m-d') ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No polylines available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="data-section mt-5">
                <h3>Polygons</h3>
                <table class="table table-hover table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Date Added</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($polygons ?? [] as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                @if ($item->image)
                                    <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}" style="max-width:120px; max-height:80px; object-fit:contain;" />
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ optional($item->created_at)->format('Y-m-d') ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No polygons available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
            </div>
        </div>
    </div>
    </div>
@endsection


