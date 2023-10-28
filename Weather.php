<?php

/*
Plugin Name: Weather Widget
Plugin URI: https://github.com/example/weather-widget
Description: This plugin displays the weather of the current location or the weather of Delhi.
Version: 1.0.0
Author: Example
Author URI: https://example.com
*/

// Get the current location or the location of Delhi.
$location = ( isset( $_GET['location'] ) ) ? $_GET['location'] : 'Delhi, India';

// Get the weather data for the specified location.
$weather_data = file_get_contents( 'https://api.openweathermap.org/data/2.5/weather?q=' . $location . '&appid=YOUR_API_KEY' );

// Decode the JSON response into an array.
$weather_array = json_decode( $weather_data );

// Get the current weather conditions.
$current_weather = $weather_array['weather'][0]['description'];
$current_temperature = $weather_array['main']['temp'];
$current_humidity = $weather_array['main']['humidity'];
$current_wind_speed = $weather_array['wind']['speed'];

// Get the weather forecast for the next 7 days.
$weather_forecast = $weather_array['list'];

// Display the weather widget.
echo '<div class="weather-widget">';
echo '<h2>Weather</h2>';
echo '<p>Current weather: ' . $current_weather . '</p>';
echo '<p>Current temperature: ' . $current_temperature . '&deg;C</p>';
echo '<p>Current humidity: ' . $current_humidity . '%</p>';
echo '<p>Current wind speed: ' . $current_wind_speed . ' m/s</p>';

echo '<h3>Weather forecast for the next 7 days:</h3>';
echo '<ul>';
foreach ( $weather_forecast as $day ) {
    echo '<li>' . $day['dt_txt'] . ': ' . $day['weather'][0]['description'] . '</li>';
}
echo '</ul>';

echo '</div>';

?>
