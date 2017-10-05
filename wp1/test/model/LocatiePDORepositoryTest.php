<?php

use \model\LocatiePDORepository;
use \model\Locatie;

class LocatiePDORepositoryTest extends PHPUnit_Framework_TestCase
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

    public function testFindLocatieById()
    {
        $locatie = $this->pdoLocatieRepository->getById(0);
        $testLocatie = new Locatie(0, "Test");
        $this->assertEquals($locatie, $testLocatie);
    }


}