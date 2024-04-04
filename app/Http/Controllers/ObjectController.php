<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Objet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ObjectController extends Controller
{
    public function index()
    {
        $objects = Client::query()->with('objets.project')->find(Auth::guard('client')->id());
        $query = request()->query('query');
        if ($query) {
            $objects = $objects->objets->where('project_id', (int) $query);
        }
        $objects = $objects->objets;
        return view('clients.objects.index', compact('objects'));
    }

    public function details(Request $request, $id)
    {
        $client = Client::query()->find(Auth::guard('client')->id());
        $object = $client->objets->find($id);
        if (!$object) {
            return redirect()->route('object');
        }
        $object = Objet::query()->with('project')->find($id);
        // call the API to get the captors data for this object
        $captors = Http::get(env('API_URL').'/devices-data?code='.$object->code);
        $data = $captors->json();
        $range = $request->query('range'); // "01/02/2024 to 02/03/2024"
        if ($range) {
            $range = explode(' to ', $range);
            $start_date = \DateTime::createFromFormat('d/m/Y', $range[0])->format('Y-m-d');
            $end_date = \DateTime::createFromFormat('d/m/Y', $range[1])->format('Y-m-d');
            $data = array_filter($data, function ($captor) use ($end_date, $start_date, $range) {
                $date = new \DateTime($captor['dateTime']);
                $date_only = $date->format('Y-m-d');
                return $date_only >= $start_date && $date_only <= $end_date;
            });
        }
        $averages = $this->getAverage($data);
        $defaultRange = $request->query('range') != null ? $request->query('range') : date('d-m-Y',
                strtotime('-1 month')).' to '.date('d-m-Y');
        $type = $this->getTypeObject($object->elements);
        if ($type == "Both" || $type == "Actuator") {
            $actuator = Http::get(env('API_URL').'/device-status?code='.$object->code);
            return view('clients.objects.details',
                compact('object', 'data', 'averages', 'defaultRange', 'type', 'actuator'));
        }
        return view('clients.objects.details', compact('object', 'data', 'averages', 'defaultRange', 'type'));
    }

    private function getAverage(array $data): array
    {
        // i want to do average on $data but i don't know in advance the keys of the array
        $average = [];
        foreach ($data as $value) {
            foreach ($value as $key => $item) {
                if ($key == 'dateTime') {
                    continue;
                }
                if (!isset($average[$key])) {
                    $average[$key] = [];
                }
                $average[$key][] = $item;
            }
        }
        foreach ($average as $key => $value) {
            $average[$key] = array_sum($value) / count($value);
        }
        return $average;
    }

    private function getTypeObject(string $type)
    {

        // search if the object is a captor or actuator or both i want to return Actuator or Captor or Both
        $elements = explode(",", $type);
        $typeObject = "";
        if (in_array("captor", $elements) && in_array("actuator", $elements)) {
            $typeObject = "Both";
        } elseif (in_array("captor", $elements)) {
            $typeObject = "Captor";
        } elseif (in_array("actuator", $elements)) {
            $typeObject = "Actuator";
        }
        return $typeObject;

    }
}

//        $graphValue = [];
//        foreach ($data as $value) {
//            $dateTime = new \DateTime($value['dateTime']);
//            $month = $dateTime->format('m');
//            if(@$value['humidite'] != null){
//                $graphValue['humidity'][$month][] = $value['humidite'];
//
//            }
//            if(@$value['temperature'] != null){
//                $graphValue['temperature'][$month][] = $value['temperature'];
//            }
//        }
// need average for humidity and temperature, luminosite, photoresistance
