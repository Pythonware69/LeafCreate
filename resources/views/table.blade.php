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
                    <input type="text" id="search" placeholder="">
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Reze</td>
                        <td>My Bini</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Asa Mitaka</td>
                        <td>My Bini</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>The Bear</td>
                        <td>FX</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Gianpiero Lamberesing</td>
                        <td>Absolutely Sticular</td>
                    </tr>
                </tbody>
            </table>

            <div class="table-footer">
            </div>
        </div>
    </div>
    </div>
@endsection


