<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Objet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
//        $response = Http::get('http://127.0.0.1:8000/api/device-data?code='.$object->code);
        $filePath = base_path('app/Data/captors.json');
        $jsonContent = File::get($filePath);
        $captors = json_decode($jsonContent, true);
        $data = $this->formatValues($captors);
        $range = $request->query('range'); // "01/02/2024 to 02/03/2024"
        if ($range) {
            $range = explode(' to ', $range);
            $start_date = \DateTime::createFromFormat('d/m/Y', $range[0])->format('Y-m-d');
            $end_date = \DateTime::createFromFormat('d/m/Y', $range[1])->format('Y-m-d');
            $data = array_filter($data, function ($captor) use ($end_date, $start_date, $range) {
                $date = new \DateTime($captor['date']);
                $date_only = $date->format('Y-m-d');
                return $date_only >= $start_date && $date_only <= $end_date;
            });
        }
        $average = $this->getAverage($data);
        $defaultRange = $request->query('range') != null ? $request->query('range') : date('d-m-Y',
                strtotime('-1 month')).' to '.date('d-m-Y');
        $type = $this->getTypeObject($object->elements);

        return view('clients.objects.details', compact('object', 'data', 'average', 'defaultRange', 'type'));
    }

    private function formatValues(array $response): array
    {
        $formattedValues = [];
        foreach ($response as $value) {
            $valuesJson = json_decode($value['values'], true);
            $finalResponse = [
                'id' => $value['id'],
                'object_id' => $value['object_id'],
                'date' => $valuesJson['dateTime'] ?? $value['created_at'],
            ];
            foreach ($valuesJson as $index => $newValue) {
                $finalResponse[$index] = $newValue;
            }
            $formattedValues[] = $finalResponse;
        }
        return $formattedValues;
    }

    private function getAverage(array $data): array
    {
        $average = [];
        foreach ($data as $value) {
            if (@$value['humidite'] != null) {
                $average['humidity']['data'] = $value['humidite'];
            }
            if (@$value['temperature'] != null) {
                $average['temperature']['data'] = $value['temperature'];
            }
            if (@$value['luminosite'] != null) {
                $average['luminosity']['data'] = $value['luminosite'];
            }
            if (@$value['photoresistance'] != null) {
                $average['photoresistance']['data'] = $value['photoresistance'];
            }
        }

        $average['humidity']['average'] = count($data) == 0 ? 0 : round(array_sum(array_column($data,
                'humidite')) / count($data), 2);
        $average['temperature']['average'] = count($data) == 0 ? 0 : round(array_sum(array_column($data,
                'temperature')) / count($data), 2);
        $average['luminosity']['average'] = count($data) == 0 ? 0 : round(array_sum(array_column($data,
                'luminosite')) / count($data), 2);
        $average['photoresistance']['average'] = count($data) == 0 ? 0 : round(array_sum(array_column($data,
                'photoresistance')) / count($data),
            2);
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
