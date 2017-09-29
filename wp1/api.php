<?php
require_once "src/autoload.php";

use view\JsonView;
use \model\LocatiePDORepository;
use \controller\LocatieController;

$pdo = null;

try {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $dbinfo = json_encode(file_get_contents("dbconnection.json"), true);
    $pdo = new PDO($dbinfo['dsn'], $dbinfo['username'], $dbinfo['password']);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $jsonView = new JsonView();

    $locatieRepository = new LocatiePDORepository($pdo);
    $locatieController = new LocatieController($locatieRepository, $jsonView);

    $router = new AltoRouter();
    $router->setBasePath('/api.php');

    // locatie mapping
    $router->map('GET', '/locatie/[i:id]',
        function ($id) use ($locatieController) {
        $locatieController->handleGetById($id);
        }
    );



} catch (\Exception $e) {
    print($e);
}