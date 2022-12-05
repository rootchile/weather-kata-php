<?php

namespace Tests\WeatherKata;

use WeatherKata\Forecast;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    /** @test */
    public function find_the_weather_of_today()
    {
        $forecast = new Forecast();
        $city     = "Madrid";

        $prediction = $forecast->predict($city);

        $this->assertEquals('sunny', $prediction->getWeatherStateName());
        $this->assertEquals(60.0, $prediction->getWindSpeed());
    }

    /** @test */
    public function find_the_weather_of_any_day()
    {
        $forecast = new Forecast();
        $city     = "Madrid";

        $prediction = $forecast->predict($city, new \DateTime('+2 days'));

        $this->assertEquals('sunny', $prediction->getWeatherStateName());
        $this->assertEquals(40.0, $prediction->getWindSpeed());
    }

    /** @test */
    public function there_is_no_prediction_for_more_than_5_days()
    {
        $forecast = new Forecast();
        $city = "Madrid";

        $prediction = $forecast->predict($city, new \DateTime('+6 days'));

        $this->assertEquals([], $prediction);
    }
}