<?php

namespace EngMahmoudElgml\GoogleIntegration\Http\Controllers;

use App\Http\Controllers\Controller;
use EngMahmoudElgml\GoogleIntegration\GoogleConnection;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function callback(Request $request): array
    {
        $conn = new GoogleConnection();
        return $conn->handleCallback($request['code']);
    }
}
