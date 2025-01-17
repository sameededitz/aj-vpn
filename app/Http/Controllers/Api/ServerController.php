<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index()
    {
        $servers = Server::with('subServers')->get();
        return response()->json([
            'status' => true,
            'servers' => $servers
        ], 200);
    }
}
