<?php
/**
 * Created by PhpStorm.
 * User: bramV
 * Date: 26/10/2017
 * Time: 11:28
 */

use PHPUnit\Framework\TestCase;
use model\Score;
use model\ScorePDORepository;
use controller\ScoreController;

class ScoreControllerTest extends TestCase
{
    private $mockJsonView;
    private $mockScore;

    public function setUp()
    {
        $this->mockScore = $this->getMockBuilder('model\ScorePDORepository')->disableOriginalConstructor()->getMock();
        $this->mockJsonView = $this->getMockBuilder('view\JsonView')->disableOriginalConstructor()->getMock();
    }

    public function tearDown()
    {
        $this->mockScore = null;
        $this->mockJsonView = null;

    }

    public function test_getScoreByIdprobleemmelding()
    {
        $score = new Score(1, 1, 1, 1);
        $this->mockScore->expects($this->atLeastOnce())
            ->method('getScoreByIdprobleemmelding')
            ->will($this->returnValue($score));
        $this->mockJsonView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $locatie = $object['toShow'];
                printf("%s", json_encode($locatie));
            }));
        $scorecontroller = new ScoreController($this->mockScore, $this->mockJsonView);
        $scorecontroller->handleGetScoreByIdprobleemmelding($score->getId());
        $this->expectOutputString(sprintf("%s", json_encode($score)));

    }

    public function test_updateScoreByIdprobleemmelding()
    {
        $scoreJson = '{"id":0,"idprobleemMelding":"1","aantalScores":"1","totaleScore":"1"}';
        $score = json_decode($scoreJson);

        $this->mockScore->expects($this->atLeastOnce())
            ->method('updateScoreByIdprobleemmelding')
            ->will($this->returnValue($score));

        $this->mockJsonView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $score = $object['toShow'];
                printf("%s", json_encode($score));
            }));

        $scorecontroller = new ScoreController($this->mockScore, $this->mockJsonView);
        $scorecontroller->handleUpdateScoreByIdprobleemmelding($scoreJson);
        $this->expectOutputString(sprintf("%s", json_encode($score)));
    }

    public function test_addScoreByIdprobleemmelding()
    {
        $scoreJson = '{"id":0,"idprobleemMelding":"1","aantalScores":"1","totaleScore":"1"}';
        $score = json_decode($scoreJson);

        $this->mockScore->expects($this->atLeastOnce())
            ->method('addScoreByIdprobleemmelding')
            ->will($this->returnValue($score));

        $this->mockJsonView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $score = $object['toShow'];
                printf("%s", json_encode($score));
            }));

        $scorecontroller = new ScoreController($this->mockScore, $this->mockJsonView);
        $scorecontroller->handleAddScoreByIdprobleemmelding($scoreJson);
        $this->expectOutputString(sprintf("%s", json_encode($score)));
    }
}