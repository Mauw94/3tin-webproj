<?php

use model\Locatie;
use controller\LocatieController;
use PHPUnit\Framework\TestCase;

class LocatieControllerTest extends TestCase
{
    private $mockLocatieRepo;
    private $mockJsonView;

    public function setUp()
    {
        $this->mockLocatieRepo = $this->getMockBuilder('model\LocatiePDORepository')->disableOriginalConstructor()->getMock();
        $this->mockJsonView = $this->getMockBuilder('view\JsonView')->disableOriginalConstructor()->getMock();
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
            ->method('getById')
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

    public function test_handleAddLocatie()
    {
        $locatieJson = '{"id":0, "naam":"test"}';
        $locatie = json_decode($locatieJson);

        $this->mockLocatieRepo->expects($this->atLeastOnce())
            ->method('addLocatie')
            ->will($this->returnValue($locatie));

        $this->mockJsonView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $event = $object['toShow'];
                printf("%s", json_encode($event));
            }));

        $locatieController = new LocatieController($this->mockLocatieRepo, $this->mockJsonView);
        $locatieController->handleAddLocatie($locatieJson);
        $this->expectOutputString(sprintf("%s", json_encode($locatie)));
    }

    public function test_handleUpdateLocatie()
    {
        $locatieJson = '{"id":0, "naam":"test"}';
        $locatie = json_decode($locatieJson);

        $this->mockLocatieRepo->expects($this->atLeastOnce())
            ->method('updateLocatie')
            ->will($this->returnValue($locatie));

        $this->mockJsonView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $event = $object['toShow'];
                printf("%s", json_encode($event));
            }));

        $locatieController = new LocatieController($this->mockLocatieRepo, $this->mockJsonView);
        $locatieController->handleUpdateLocatie($locatieJson);
        $this->expectOutputString(sprintf("%s", json_encode($locatie)));
    }

    public function test_handleDeleteLocatie()
    {
        $this->mockLocatieRepo->expects($this->atLeastOnce())
            ->method('deleteLocatie')
            ->will($this->returnValue(null));

        $locatieController = new LocatieController($this->mockLocatieRepo, $this->mockJsonView);
        $locatieController->handleDeleteLocatie(0);
        $this->expectOutputString('');
    }
}