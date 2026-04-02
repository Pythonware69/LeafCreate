<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $data = [
            'title' => 'Home',
        ];
        return view('welcome', $data);
    }

    public function peta()
    {
        $data = [
            'title' => 'Peta Jakarta',
        ];
        return view('map', $data);
    }

    public function tabel()
    {
        $data = [
            'title' => 'Tabel Data',
        ];
        return view('tabel', $data);
    }
}
