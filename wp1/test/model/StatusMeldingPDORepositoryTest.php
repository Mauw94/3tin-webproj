<?php
/**
 * Created by PhpStorm.
 * User: bramV
 * Date: 15/10/2017
 * Time: 17:25
 */
require_once 'vendor/autoload.php';
use model\StatusMeldingPDORepository;
use model\StatusMelding;
use \PHPUnit\Framework\TestCase;
class StatusMeldingPDORepositoryTest extends TestCase
{
    private $pdorepository;
    public function setUp()
    {
        $this->connection = new PDO('sqlite::memory:');
        $this->connection->exec('CREATE TABLE statusmelding (
                        id INT,
                        locatieid INT, 
                        status VARCHAR,
                        datum DATE
                   )');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdorepository = new StatusMeldingPDORepository($this->connection);
    }
    public function tearDown(){
        $this->pdorepository = null;
    }
    public function test_addStatusMelding(){
        $statusmelding = new StatusMelding(1,1,1,"2017-10-15");
        $return = $this->pdorepository->addStatusMelding($statusmelding);
        $this->assertEquals($statusmelding,$return);
    }

}