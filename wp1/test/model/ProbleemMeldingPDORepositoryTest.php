<?php
/**
 * Created by PhpStorm.
 * User: bramV
 * Date: 18/10/2017
 * Time: 16:43
 */
require_once 'vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use model\ProbleemMeldingPDORepository;
use model\ProbleemMelding;

class ProbleemMeldingPDORepositoryTest extends TestCase
{
    private $pdoMeldingRepository;
    public function setUp()
    {
        $this->connection = new PDO('sqlite::memory:');
        $this->connection->exec('CREATE TABLE probleemmelding(
                        id INT, 
                        locatieid INT,
                        probleem VARCHAR,
                        datum DATE,
                        afgehandeld tinyint
                   )');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdoMeldingRepository = new ProbleemMeldingPDORepository($this->connection);
    }

    public function tearDown()
    {
        $this->pdoMeldingRepository = null;
    }

    public function test_addprobleemmelding(){
        $melding = new ProbleemMelding(1,1,"kapot toilet","2017-10-18",0);
        $return = $this->pdoMeldingRepository->addProbleemMelding($melding);
        $this->assertEquals($melding, $return);
    }

}