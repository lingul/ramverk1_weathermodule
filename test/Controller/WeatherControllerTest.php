<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * WeatherControllerTest.
 */
class WeatherControllerTest extends TestCase
{

    public function setUp()
    {
        global $di;

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        $this->di = $di;

        $this->controller = new WeatherController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $body = $res->getBody();
        $this->assertContains("Kommande väder", $body);
    }
}
