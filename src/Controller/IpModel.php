<?php

namespace Anax\Controller;

class IpModel
{
    public function ipValidate($ipAddress) : array
    {
        $version = null;
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) || filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $check = $ipAddress . " is OK";
            $version = strpos($ipAddress, ".") === false ? 6 : 4;
            $hostname = gethostbyaddr($ipAddress);
            if ($hostname == $ipAddress) {
                $hostname = "Not found";
            }
        } else {
            $check = $ipAddress . " is NOT OK ip address";
            $hostname = "Not found";
        }
        return [$check, $hostname, $version];
    }

    public function local() : string
    {
        return file_get_contents("http://ipecho.net/plain");
    }

    public function ipValidateJson($ipAddress) : array
    {
        $version = null;
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) || filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $check = $ipAddress . " is OK";
            $version = strpos($ipAddress, ".") === false ? "ipv6" : "ipv4";
            $hostname = gethostbyaddr($ipAddress);
            if ($hostname == $ipAddress) {
                $hostname = "Not found";
            }
        } else {
            $check = $ipAddress . " is NOT OK ip address";
            $hostname = "Not found";
        }
        return ["ip" => $check, "domain" => $hostname, "type" => $version];
    }

    public function ipStack($ipAddress)
    {
        // $path = ANAX_INSTALL_PATH . "/config/api.txt";
        $keys = require(ANAX_INSTALL_PATH . "/config/api.php");
        // $accessKey = file_get_contents($path[0]);

        $accessKey = $keys[0];
        // $handle = fopen(ANAX_INSTALL_PATH . "/config/api.txt", "r");
        // if ($handle) {
        //         $accessKey = fgets($handle);
        //         // echo $line;
        //     }
        //     fclose($handle);
        // Initialize CURL:
        $chr = curl_init('http://api.ipstack.com/'.$ipAddress.'?access_key='.trim($accessKey).'');
        curl_setopt($chr, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($chr);
        curl_close($chr);
        $controll = $this->ipValidateJson($ipAddress);


        // Decode JSON response:
        $apiResult = json_decode($json, true, JSON_UNESCAPED_UNICODE);
        $apiResult["ip check"] = $controll["ip"];
        $apiResult["domain"] = $controll["domain"];
        // if (trim($accessKey) === $k) {
        //     return "lika";
        // } else {
        //     return var_dump(trim());
        // }
        return $apiResult;
    }
}
