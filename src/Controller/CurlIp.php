<?php

namespace Anax\Controller;

class CurlIp
{
    private $key;

    /**
     * Set key
     *
     * @param: string $key key to set.
     *
     */
    public function setKey($key)
    {
        $this->key = $key;
    }


    /**
     * Curl ip
     *
     * @param: string $url where to create the curl.
     *
     * @return object With api results
     */
    public function curl($ip)
    {
        $access_key = $this->key;
        $url = 'http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'';

        // Initialize CURL:
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $api_result = json_decode($json, true);

        return $api_result;
    }
}
