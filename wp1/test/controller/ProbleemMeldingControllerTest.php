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
        $probleem = new ProbleemMelding(1, "test", "probleem", 19/19/2019, 0 , 0);
        $this->mockProbleemMeldingRepo->expects($this->atLeastOnce())
            ->method('getById')
            ->will($this->returnValue($probleem));

        $this->mockJsonView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $locatie = $object['toShow'];
                printf("%s", json_encode($locatie));
            }));

        $probleemMeldingController = new ProbleemMeldingController($this->mockProbleemMeldingRepo, $this->mockJsonView);
        $probleemMeldingController->handleGetById($probleem->getId());
        $this->expectOutputString(sprintf("%s", json_encode($probleem)));
    }

    public function test_addProbleemMelding()
    {
        $probleemMeldingJson = '{"id":0,"locatieid":"1","probleem":"Kapot","datum":"2017-10-11","afgehandeld":"1","updownvote":"0"}';
        $probleemMelding = json_decode($probleemMeldingJson);

        $this->mockProbleemMeldingRepo->expects($this->atLeastOnce())->method('addProbleemMelding')
            ->will($this->returnValue($probleemMelding));

        $this->mockJsonView->expects($this->atLeastOnce())->method('show')
            ->will($this->returnCallback(function ($object){
                $probleem = $object['toShow'];
                printf("%s", json_encode($probleem));
            }));

        $probleemMeldingController = new ProbleemMeldingController($this->mockProbleemMeldingRepo, $this->mockJsonView);
        $probleemMeldingController->handleAddProbleemMelding($probleemMeldingJson);
        $this->expectOutputString(sprintf("%s", json_encode($probleemMelding)));
    }
}