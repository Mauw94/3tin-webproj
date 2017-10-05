<?php

use \model\LocatiePDORepository;
use \model\Locatie;

class LocatiePDORepositoryTest extends \PHPUnit_Framework_TestCase
{
    private $pdoLocatieRepository;

    public function setUp()
    {
        $pdo = new PDO("url=localhost;dbname=web-project3tin", "root", "");
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