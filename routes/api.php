<?php

use App\Models\Captor;
use App\Models\Objet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

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

Route::get('/last-captor', function (Request $request){
    return response()->json(
        ['humidite' => 34, "temperature" => 15]
    );
});

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

Route::get('/device-data', function (Request $request) {
    // generate code to read file in app/Data/captors.json



    $code = $request->query('code');
    $filePath = base_path('app/Data/captors.json');
    if (File::exists($filePath)) {
        $jsonContent = File::get($filePath);
        $captors = json_decode($jsonContent, true);
        return response()->json($captors);
    } else {
        return response()->json(['error' => 'Fichier introuvable'], 404);
    }
});
