<?php

use App\Models\Captor;
use App\Models\Objet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/secret/endpoint-values-captors-json-payload', function (Request $request) {
    $payload = $request->all();
    $code = $payload['code'];
    $object = Objet::where('code', $code)->firstOrfail();
    Log::info('Payload received: ', ['payload' => $payload, 'object' => $object]);
    Captor::create([
        'values' => json_encode($payload),
        'object_id' => $object->id
    ]);
    return response()->json(['status' => 200, 'message' => 'success']);
});
