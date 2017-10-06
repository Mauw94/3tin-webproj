<?php

use \model\Locatie;
use \controller\LocatieController;
use PHPUnit\Framework\TestCase;
<<<<<<< HEAD

=======
>>>>>>> f0e4ec14f89e19aa1b62ea9663ec35b221658e6d
class LocatieControllerTest extends TestCase
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

    public function test_handleAddLocatie()
    {
        $locatieJson = '{"id":0, "naam":"test"}';
        $locatie = json_decode($locatieJson);

        $this->mockLocatieRepo->expects($this->atLeastOnce())
            ->method('handleAddLocatie')
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
            ->method('handleUpdateLocatie')
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
            ->method('handleDeleteLocatie')
            ->will($this->returnValue(null));

        $locatieController = new LocatieController($this->mockLocatieRepo, $this->mockJsonView);
        $locatieController->handleDeleteLocatie(0);
        $this->expectOutputStrin('');
    }
}