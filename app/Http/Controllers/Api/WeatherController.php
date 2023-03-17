<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWeatherRequest;
use App\Http\Requests\UpdateWeatherRequest;
use App\Models\Weather;
use App\Http\Resources\WeatherResource;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WeatherResource::collection(
            Weather::query()->orderBy("id", "desc")->paginate(100)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWeatherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWeatherRequest $request)
    {
        $data = $request->validated();
        $Weather = Weather::create($data);
        return response(new WeatherResource($Weather), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Weather  $Weather
     * @return \Illuminate\Http\Response
     */
    public function show(Weather $Weather)
    {
        return new WeatherResource($Weather);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWeatherRequest  $request
     * @param  \App\Models\Weather  $Weather
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWeatherRequest $request, Weather $Weather)
    {
        $data = $request->validated();
        $Weather->update($data);

        return new WeatherResource($Weather);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weather  $Weather
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weather $Weather)
    {
        $Weather->delete();

        return response("", 204);
    }
}
