<?php

namespace Anax\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
* To ease rendering a page consisting of several views.
*@SuppressWarnings(PHPMD)
*/
class Weather implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    public function dates($start, $end) : array
    {
        $old = new \DateTime();
        if ($start) {
            $old->modify($start);
        }
        $dates = [];
        $day = 0;
        while ($day <= $end) {
            $dates[] = $old->format("Y-m-d");
            $old->modify('+1 day');
            $day+=1;
        }
        return $dates;
    }

    public function newWeather($lat, $long)
    {
        $keys = require(ANAX_INSTALL_PATH . "/config/api.php");
        // $accessKey = file_get_contents($path[0]);

        $accessKey = $keys[1];

        $chr = curl_init('https://api.darksky.net/forecast/'.$accessKey.'/'.$lat.','.$long.'?exclude=flags,hourly,minutley,currently');
        curl_setopt($chr, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($chr);
        curl_close($chr);
        $apiResult = json_decode($json, true);
        if (isset($apiResult[0]["code"])) {
            return $apiResult[0]["error"].'. Bad latitude longitude, could not retrive weather. Try again';
        }
        if (isset($apiResult["error"])) {
            return $apiResult["error"].'. Bad latitude longitude, could not retrive weather. Try again';
        }
        return $apiResult["daily"]["data"];
    }

    public function histWeather($lat, $long)
    {
        $keys = require(ANAX_INSTALL_PATH . "/config/api.php");
        // $accessKey = file_get_contents($path[0]);

        $accessKey = $keys[1];

        // $currDate = new \DateTime();
        $old = new \DateTime();
        $old->modify('-31 day');

                // array of curl handles
        $multiCurl = array();
        // data to be returned
        $result = array();
        // multi handle
        $umha = curl_multi_init();
        $day = 0;
        while ($day <=30) {
            // URL from which data will be fetched
            $fetchURL = 'https://api.darksky.net/forecast/'.$accessKey.'/'.$lat.','.$long.','.$old->format("Y-m-d").'T12:00:00?exclude=flags,hourly,minutley,currently';
            $old->modify('+1 day');
            $multiCurl[$day] = curl_init();
            curl_setopt($multiCurl[$day], CURLOPT_URL, $fetchURL);
            curl_setopt($multiCurl[$day], CURLOPT_HEADER, 0);
            curl_setopt($multiCurl[$day], CURLOPT_RETURNTRANSFER, 1);
            curl_multi_add_handle($muha, $multiCurl[$day]);
            $day+=1;
        }
        $index=null;
        do {
            curl_multi_exec($muha, $index);
        } while ($index);
        // get content and remove handles
        foreach ($multiCurl as $k) {
            curl_multi_remove_handle($muha, $k);
        }
        $data = null;
        foreach ($multiCurl as $ch) {
            $data = curl_multi_getcontent($ch);
            $result[] = json_decode($data, true);
        }
        // $i = 0;
        $fixedResult = [];
        if (isset($result[0]["code"])) {
            return $result[0]["error"].'. Bad latitude longitude, could not retrive weather. Try again';
        }
        if (isset($result[0]["error"])) {
            return $result[0]["error"].'. Bad latitude longitude, could not retrive weather. Try again';
        }
        foreach ($result as $res) {
            $fixedResult[] = $res["daily"]["data"];
            // $i+=1;
        }
        // close
        curl_multi_close($muha);
        return $fixedResult;
    }
    public function json($apiResult, $dates, $type)
    {
        if (is_string($apiResult)) {
            return ["Error" => $apiResult];
        }
        if ($type == "h") {
            foreach ($apiResult as $day) {
                $summaries[] = $day[0]["summary"];
            }
            $counter = 0;
            foreach ($dates as $day) {
                $res["date"] = $day;
                $res["summary"] = $summaries[$counter];
                $arr[] = $res;
                // $res[$day] = $summaries[$counter];
                $counter += 1;
            }
        } elseif ($type == "k") {
            foreach ($apiResult as $day) {
                $summaries[] = $day["summary"];
            }
            $counter = 0;
            foreach ($dates as $day) {
                $res["date"] = $day;
                $res["summary"] = $summaries[$counter];
                $arr[] = $res;
                // $res[$day] = $summaries[$counter];
                $counter += 1;
            }
        }
        return $arr;
    }
}
