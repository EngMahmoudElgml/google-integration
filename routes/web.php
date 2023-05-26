<?php

$url = config('google.credentials.web.redirect_uris.0');
$parts = explode('/' , $url );

$callback = '' ;
for ($i=3 ; $i < count($parts) ; $i++ ){
    $callback .=  '/' . $parts[$i]   ;
}

\Illuminate\Support\Facades\Route::get($callback,[\EngMahmoudElgml\GoogleIntegration\Http\Controllers\GoogleController::class,'callback']);
