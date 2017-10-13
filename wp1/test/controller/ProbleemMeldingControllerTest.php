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


}