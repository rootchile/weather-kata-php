<?php

namespace WeatherKata;

use WeatherKata\Http\Client;
use WeatherKata\Prediction;

class Forecast
{   
    private $client;
    const MAX_PREDICTABLE_DATETIME = "+6 days 00:00:00";

    public function __construct(){
        $this->client = new Client();
    }

    private function getWeatherDataByCity(string &$city) {
        $woeid = $this->client->get("https://www.metaweather.com/api/location/search/?query=$city");
        $city = $woeid;
        $results = $this->client->get("https://www.metaweather.com/api/location/$woeid");
        
        return $results;
    }

    private function getPredictionsByCity($city) {
        $predictions = [];
        $results = $this->getWeatherDataByCity($city);
        foreach ($results as $r) {
            $prediction = new Prediction($r['applicable_date'],$r['wind_speed'], $r['weather_state_name']);
            array_push($predictions,$prediction);
        }
        return $predictions;
    }

    private function filterPredictionByDate($predictions,$datetime) {
        foreach ($predictions as $predObj) {
            if($predObj->getApplicableDate() == $datetime->format('Y-m-d')) {
                return $predObj;
            }
        }
        return [];
    }

    private function isValidPredictionDate(\Datetime $datetime) {
        return ($datetime < new \DateTime(self::MAX_PREDICTABLE_DATETIME));
    }

    public function predict(string &$city, \DateTime $datetime = null )
    {   
        if(!$datetime) {
            $datetime = new \DateTime();
        }

        if (!$this->isValidPredictionDate($datetime)) {
            return [];
        }

        $predictions = $this->getPredictionsByCity($city);
        
        if (count($predictions)===0){
            return [];
        }
        
        $prediction = $this->filterPredictionByDate($predictions,$datetime);
        $results = $this->getWeatherDataByCity($city);

        return $prediction;
    }
}