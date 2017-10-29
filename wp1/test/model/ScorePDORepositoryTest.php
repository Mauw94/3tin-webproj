<?php
/**
 * Created by PhpStorm.
 * User: bramV
 * Date: 13/10/2017
 * Time: 10:07
 */
require_once 'vendor/autoload.php';

use model\ScorePDORepository;
use model\Score;
use \PHPUnit\Framework\TestCase;

class ScorePDORepositoryTest extends TestCase
{
    private $pdoRepositoryScore;

    public function setUp()
    {
        $this->connection = new PDO('sqlite::memory:');
        $this->connection->exec('CREATE TABLE score (
                        id INT,
                        idprobleemmelding INT, 
                        aantalscores INT,
                        totalescore INT
                   )');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdoRepositoryScore = new ScorePDORepository($this->connection);
    }

    public function tearDown()
    {
        $this->pdoRepositoryScore = null;
    }

    public function test_AddScore()
    {
        $score = new Score(1, 1, 1, 1);
        $return = $this->pdoRepositoryScore->addScoreByIdprobleemmelding($score);
        $this->assertEquals($score, $return);
    }

    public function test_GetScoreById()
    {
        $score = new Score(1, 1, 10, 40);
        $this->pdoRepositoryScore->addScoreByIdprobleemmelding($score);
        $return = $this->pdoRepositoryScore->getScoreByIdprobleemmelding(1);
        $this->assertEquals($score->getIdProbleemMelding(), $return->getIdProbleemmelding());
    }

    public function test_UpdateScoreById()
    {
        $score = new Score(1, 1, 10, 40);
        $this->pdoRepositoryScore->addScoreByIdprobleemmelding($score);

        $score = new Score(1, 1, 15, 50);
        $return = $this->pdoRepositoryScore->updateScoreByIdprobleemmelding($score);


        $this->assertEquals(50, $return->getTotalescore());
    }

    public function test_GemScoreById()
    {
        $score = new Score(1, 1, 10, 40);
        $return = $this->pdoRepositoryScore->addScoreByIdprobleemmelding($score);
        $this->assertEquals(4, $return->getGemscores());
    }
}