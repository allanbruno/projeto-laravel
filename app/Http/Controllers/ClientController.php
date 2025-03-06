<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
       $clients = Client::search($request->search)->defaultOrder()->paginate(10);

        return view('pages.client.list', compact('clients'));
    }
}
