<?php
/**
 * Created by PhpStorm.
 * User: bramV
 * Date: 26/10/2017
 * Time: 15:37
 */
use PHPUnit\Framework\TestCase;
use controller\StatusMeldingController;
use model\StatusMelding;
use model\StatusMeldingPDORepository;

class StatusMeldingControllerTest extends TestCase
{
    private $mockJsonView;
    private $mockStatusMelding;

    public function setUp(){
        $this->mockStatusMelding = $this->getMockBuilder('model\StatusMeldingPDORepository')->disableOriginalConstructor()->getMock();
        $this->mockJsonView = $this->getMockBuilder('view\JsonView')->disableOriginalConstructor()->getMock();
    }

    public function tearDown()
    {
        $this->mockJsonView = null;
        $this->mockStatusMelding = null;
    }

    public function test_handleGetById()
    {
        $statusmelding = new StatusMelding(1,1,"Afgewerkt","2017-10-26");
        $this->mockStatusMelding->expects($this->atLeastOnce())
            ->method('getById')
            ->will($this->returnValue($statusmelding));

        $this->mockJsonView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $locatie = $object['toShow'];
                printf("%s", json_encode($locatie));
            }));

        $statusmeldingController = new StatusMeldingController($this->mockStatusMelding, $this->mockJsonView);
        $statusmeldingController->handleGetById($statusmelding->getId());
        $this->expectOutputString(sprintf("%s", json_encode($statusmelding)));
    }
}