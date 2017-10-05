<?php

use \model\Locatie;
use \controller\LocatieController;

class LocatieControllerTest extends PHPUnit_Framework_TestCase
{
    private $mockLocatieRepo;
    private $mockJsonView;

    public function setUp()
    {
        $this->mockLocatieRepo = $this->getMockBuilder('model\LocatieRepository')->getMock();
        $this->mockJsonView = $this->getMockBuilder('view\JsonView')->getMock();
    }

    public function tearDown()
    {
        $this->mockLocatieRepo = null;
        $this->mockJsonView = null;
    }

    public function test_handleFindLocatieById_locatieFound()
    {
        $locatie = new Locatie(1, "test");
        $this->mockLocatieRepo->expects($this->atLeastOnce())
            ->method('handleGetById')
            ->will($this->returnValue($locatie));

        $this->mockJsonView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $locatie = $object['toShow'];
                printf("%s", json_encode($locatie));
            }));

        $locatieController = new LocatieController($this->mockLocatieRepo, $this->mockJsonView);
        $locatieController->handleGetById($locatie->getId());
        $this->expectOutputString(sprintf("%s", json_encode($locatie)));
    }
}