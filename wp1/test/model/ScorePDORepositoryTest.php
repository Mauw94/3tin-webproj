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

class ScorePDORepositoryTest
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
    public function tearDown(){
        $this->pdoRepositoryScore = null;
    }

    public function test_AddScore(){
        $score = new Score(1,1,1,1);
        $return = $this->pdoRepositoryScore->addScoreByIdprobleemmelding($score);
        $this->assertEquals($score,$return);
    }

}