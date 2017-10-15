<?php
require_once 'vendor/autoload.php';

use model\LocatiePDORepository;
use model\Locatie;
use \PHPUnit\Framework\TestCase;

class LocatiePDORepositoryTest extends TestCase
{
    private $pdoLocatieRepository;

    public function setUp()
    {
        $this->connection = new PDO('sqlite::memory:');
        $this->connection->exec('CREATE TABLE locatie (
                        id INT, 
                        naam VARCHAR(255),
                        PRIMARY KEY (id)
                   )');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdoLocatieRepository = new LocatiePDORepository($this->connection);
    }

    public function tearDown()
    {
        $this->pdoLocatieRepository = null;
    }

    public function test_AddLocation(){
        $locatie = new Locatie(1, "Hasselt");
        $return = $this->pdoLocatieRepository->addLocatie($locatie);
        $this->assertEquals($locatie,$return);
    }
    public function test_FindLocatieById_found()
    {
        $testLocatie = new Locatie(1, "Hasselt");
        $this->pdoLocatieRepository->addLocatie($testLocatie);
        $locatie = $this->pdoLocatieRepository->getById(1);
        $this->assertEquals($testLocatie, $locatie);
    }

    public function test_findLocatieById_nothing()
    {
        $locatie = $this->pdoLocatieRepository->getById(99999);
        $this->assertEquals(null, $locatie);
    }

    public function test_added_error()
    {
        $locatie = new Locatie("a", "b");
        $return = $this->pdoLocatieRepository->addLocatie($locatie);
        $this->assertNull($return);
    }

    public function test_delete_error()
    {
        $return = $this->pdoLocatieRepository->deleteLocatie(9878);
        $this->assertEquals(0, $return);
    }
}