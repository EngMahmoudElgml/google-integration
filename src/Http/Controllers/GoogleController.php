<?php

namespace EngMahmoudElgml\GoogleIntegration\Http\Controllers;

use App\Http\Controllers\Controller;
use EngMahmoudElgml\GoogleIntegration\GoogleConnection;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function callback(Request $request){
        $conn = new GoogleConnection();
        $accessToken = $conn->getClient()->fetchAccessTokenWithAuthCode($request['code']);

        return $accessToken;
    }
}
