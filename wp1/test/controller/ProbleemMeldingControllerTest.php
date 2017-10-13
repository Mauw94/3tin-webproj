<?php

namespace controller;

use controller\ProbleemMeldingController;
use model\ProbleemMelding;
use PHPUNIT\Framework\TestCase;

class ProbleemMeldingControllerTest extends TestCase
{
    private $mockJsonView;
    private $mockProbleemMeldingRepo;

    public function setUp() {
        $this->mockProbleemMeldingRepo = $this->getMockBuilder('model\ProbleemMeldingPDORepository')->disableOriginalConstructor()->getMock();
        $this->mockJsonView = $this->getMockBuilder('view\JsonView')->disableOriginalConstructor()->getMock();
    }

    public function tearDown()
    {
        $this->mockProbleemMeldingRepo = null;
        $this->mockJsonView = null;
    }

    public function test_getById_probleemMeldingFound()
    {
        $probleem = new ProbleemMelding(1, "test", "probleem", 19/19/2019, 0);
        $this->mockLocatieRepo->expects($this->atLeastOnce())
            ->method('getById')
            ->will($this->returnValue($probleem));

        $this->mockJsonView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $locatie = $object['toShow'];
                printf("%s", json_encode($locatie));
            }));

        $probleemMeldingController = new LocatieController($this->mockLocatieRepo, $this->mockJsonView);
        $probleemMeldingController->handleGetById($probleem->getId());
        $this->expectOutputString(sprintf("%s", json_encode($probleem)));
    }

    
}