<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

use App\Models\Weather;
use App\Services\Api\WeatherApiService;
use Illuminate\Support\Facades\Log;

class WeatherSaveController extends Controller
{
    private $cites = [
        'Moscow' => 'Europe/Moscow',
        'Beijing'  => 'Asia/Shanghai',
        'Ashdod'  => 'Asia/Jerusalem'
    ];

    public function saveWeatherData()
    {
        foreach ($this->cites as $city => $timeZone){
            $data = new WeatherApiService;
            $data = $data->getCityWeather($city);

            if (!is_array($data)) {
                throw new Exception('Unexpected response from WeatherApiService');
            }

            $dateNow = new DateTime('now', new DateTimeZone($timeZone));

            $recordWeather = Weather::create([
                'city' => $city,
                'temperature' => $data['main']['temp'] - 273,
                'wind' => $data['wind']['speed'],
                'humidity' => $data['main']['humidity'],
                'pressure' => $data['main']['pressure'],
                'date' => $dateNow->format('Y-m-d H:i:s')
            ]);

        }

    }

}
