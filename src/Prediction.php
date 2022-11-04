<?php
namespace WeatherKata;

class Prediction {
    
    private $applicable_date;
    private $wind_speed;
    private $weather_state_name;

    public function __construct(string $applicable_date, float $wind_speed, string $weather_state_name) {
        $this->applicable_date = $applicable_date;
        $this->wind_speed = $wind_speed;
        $this->weather_state_name = $weather_state_name;
    }

    public function getWindSpeed(){
        return $this->wind_speed;
    }

    public function getApplicableDate() {
        return $this->applicable_date;
    }

    public function getWeatherStateName() {
        return $this->weather_state_name;
    }

}