<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherJsonControllerTest extends TestCase
{
    /**
     * Test the SampleController.
     */
    public function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        $di = $this->di;

        $this->controller = new WeatherJsonController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
        $request = $this->di->get("request");
    }

     /**
      * Test the route "index".
      */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $body = $res->getBody();
        $this->assertContains("IP JSON", $body);
    }

    /**
    * Test "JsonAction()".
    */
    public function testJsonAction()
    {
        $res = $this->controller->jsonAction();
        $this->assertInternalType("array", $res);
    }
}
