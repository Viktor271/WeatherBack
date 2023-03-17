<?php
namespace App\Services\Api;

use Illuminate\Support\Facades\Http;

class WeatherApiService {

    private $apiKey = '67dbd60f31be67316dfd031e4bc63bc2';

    public function getCityWeather($city)
    {

        $response = Http::get('https://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=' . $this->apiKey);

        if ($response->status() !== 200) {
            throw new Exception('Сonnection error weather API');
        }

        return $response->json();
    }
}