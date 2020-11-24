<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "ipstack" => [
            "shared" => true,
            "callback" => function () {
                $ipstack = new \Anax\Controller\CurlIp();
                $cfg = $this->get("configuration");
                $config = $cfg->load("ApiKeys.php");
                $ipstack->setKey($config['config']['ipstack']);


                return $ipstack;
            }
        ],
    ],
];
