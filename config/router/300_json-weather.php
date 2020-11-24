<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather JSON controller",
            "mount" => "jsonweather",
            "handler" => "\Anax\Controller\WeatherJsonController",
        ],
    ]
];
