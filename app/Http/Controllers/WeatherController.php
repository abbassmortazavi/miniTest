<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function test()
    {

        $url = 'https://www.accuweather.com/en/ir/tehran/210841/daily-weather-forecast/210841';
        $string = 'param=5';

        $ch = curl_init();

        // CURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Content-Length: ' . strlen($string)));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $string);

        return curl_exec($ch);
//        $client = new \GuzzleHttp\Client();
//
//        $request = $client->get('http://testmyapi.com');
//
//        $response = $request->getBody();
//
//        dd($response);
    }
}
