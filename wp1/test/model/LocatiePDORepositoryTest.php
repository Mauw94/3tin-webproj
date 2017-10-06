<?php

use \model\LocatiePDORepository;
use \model\Locatie;
use \PHPUnit\Framework\TestCase;

class LocatiePDORepositoryTest extends TestCase
{
    private $pdoLocatieRepository;

    public function setUp()
    {
        $pdo = new PDO("mysql:host=192.168.33.11;dbname=web-project3tin", "admin", "admin");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdoLocatieRepository = new LocatiePDORepository($pdo);
    }

    public function tearDown()
    {
        $this->pdoLocatieRepository = null;
    }

    public function test_FindLocatieById_found()
    {
        $locatie = $this->pdoLocatieRepository->getById(0);
        $testLocatie = new Locatie(0, "Test");
        $this->assertEquals($locatie, $testLocatie);
    }

    public function test_findLocatieById_nothing()
    {
        $locatie = $this->pdoLocatieRepository->getById(-1);
        $this->assertEquals($locatie, null);
    }

    public function test_findLocatieById_error()
    {
        $locatie = $this->pdoLocatieRepository->getById("a");
        $this->assertEquals($locatie, null);
    }

    public function test_added_error()
    {
        $locatie = new Locatie("a", "b");
        $return = $this->pdoLocatieRepository->addLocatie($locatie);
        $this->assertNull($return);
    }

    public function test_delete_error()
    {
        $return = $this->pdoLocatieRepository->deleteLocatie("a");
        $this->assertNull($return);
    }

}