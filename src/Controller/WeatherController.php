<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Controller\IpModel;

// Turn off all error reporting
error_reporting(0);
// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
* A sample controller to show how a controller class can be implemented.
* The controller will be injected with $di if implementing the interface
* ContainerInjectableInterface, like this sample class does.
* The controller is mounted on a particular route and can then handle all
* requests for that mount point.
*
*@SuppressWarnings(PHPMD.TooManyPublicMethods)
*/
class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $model;



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->model = new IpModel();
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $weather = $this->di->get("weather");
        $title = "ip validator with map";
        $request = $this->di->get("request");
        $ipAddress = $request->getGet("ipMap") ?? null;
        $version = null;
        $localIP = $this->model->local();
        $res = null;
        $lat = $res["latitude"];
        $long = $res["longitude"];
        // $t = $weather->histWeather($lat, $long);
        $country = $res["country_name"];
        $region = $res["region_name"];
        $hostname = null;
        $check = null;
        $answer = null;
        $summaries = [];
        $dates = null;
        if ($ipAddress !== null) {
            $type = $request->getGet("type") ?? null;
            if (strpos($ipAddress, ":") || strpos($ipAddress, ",") == false) {
                $response = $this->model->ipValidate($ipAddress);
                $check = $response[0];
                $hostname = $response[1];
                $version = $response[2];
                $res = $this->model->ipStack($ipAddress);
                $lat = $res["latitude"];
                $long = $res["longitude"];
            } elseif (strpos($ipAddress, ",")) {
                $latlong = explode(",", $ipAddress);
                $lat = $latlong[0];
                $long = $latlong[1];
            }

            $this->checkhist($answer, $type, $weather, $lat, $long, $dates, $summaries);

            $country = $res["country_name"];
            $region = $res["region_name"];
        }
        $data = [
            "check" => $check,
            "hostname" => $hostname,
            "localIP" => $localIP,
            "type" => $version,
            "lat" => $lat,
            "long" => $long,
            "country" => $country,
            "region" => $region,
            "tja" => $summaries,
            "dates" => $dates,
            "hist" => $answer

        ];
        $page->add("weather/forms_weather", $data);
        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Check historik and kommande
     */
    private function checkhist($answer, $type, $weather, $lat, $long, $dates, $summaries) {
        if ($type == "Historik") {
            $answer = $weather->histWeather($lat, $long);
            if (!is_string($answer)) {
                foreach ($answer as $day) {
                    $summaries[] = $day[0]["summary"];
                }
                $dates = $weather->dates('-31 day', 30);
            }
        } elseif ($type == "Kommande") {
            $answer = $weather->newWeather($lat, $long);
            if (!is_string($answer)) {
                foreach ($answer as $day) {
                    $summaries[] = $day["summary"];
                }
                $dates = $weather->dates(' +1 day', 7);
            }
        }
    }

}
