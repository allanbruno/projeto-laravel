<?php

namespace App\Http\Controllers;

class ClientController extends Controller
{
    public function index()
    {
        return view('pages.client.list');
    }
}
