<?php

require_once "vendor/autoload.php";

use view\JsonView;
use model\LocatiePDORepository;
use model\StatusMeldingPDORepository;
use controller\StatusMeldingController;
use model\ProbleemMeldingPDORepository;
use controller\ProbleemMeldingController;
use controller\LocatieController;

$container = require __DIR__ . '/src/app/container.php';
$pdo = null;

try {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $dbinfo = json_decode(file_get_contents('dbconnection.json'), true);
    $pdo = new PDO($dbinfo['dsn'], $dbinfo['username'], $dbinfo['password']);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requestBody = file_get_contents("php://input");
    $jsonView = new JsonView();
    $locatieRepository = new LocatiePDORepository($pdo);
    $locatieController = new LocatieController($locatieRepository, $jsonView);

    $probleemMeldingRepo = new ProbleemMeldingPDORepository($pdo);
    $probleemMeldingController = new ProbleemMeldingController($probleemMeldingRepo, $jsonView);

    $statusMeldingRepo = new StatusMeldingPDORepository($pdo);
    $statusMeldingController = new StatusMeldingController($statusMeldingRepo, $jsonView);

    $router = new AltoRouter();
    $router->setBasePath('/');

    $router->map('GET', '/', function () {
        require   'src/view/JsonView.php';
    });

    $router->map('GET', 'locaties/', function () use (&$locatieController, $requestBody) {
        $locatieController->handleGetAll($requestBody);
    });

    $router->map('GET', 'locaties/[i:id]', function ($id) use (&$locatieController) {
        $locatieController->handleGetById($id);
    });

    $router->map('POST', 'locaties/',
        function () use ($locatieController, $requestBody) {
            $locatieController->handleAddLocatie($requestBody);
        }
    );

    $router->map('PUT', 'locaties/',
        function () use (&$locatieController, $requestBody) {
            $locatieController->handleUpdateLocatie($requestBody);
        }
    );

    $router->map('DELETE', 'locaties/[i:id]', function ($id) use (&$locatieController) {
        $locatieController->handleDeleteLocatie($id);
    });

    $router->map('GET', 'problemen/', function () use (&$probleemMeldingController, $requestBody) {
        $probleemMeldingController->handleGetAll($requestBody);
    });

    $router->map('GET', 'problemen/[i:id]', function ($id) use (&$probleemMeldingController) {
        $probleemMeldingController->handleGetById($id);
    });

    $router->map('POST', 'problemen/', function () use (&$probleemMeldingController, $requestBody) {
        $probleemMeldingController->handleAddProbleemMelding($requestBody);
    });

    $router->map('PUT', 'problemen/', function () use (&$probleemMeldingController, $requestBody) {
        $probleemMeldingController->handleUpdateProbleemMelding($requestBody);
    });

    $router->map('DELETE', 'problemen/[i:id]', function ($id) use (&$probleemMeldingController) {
        $probleemMeldingController->handleDeleteProbleemMelding($id);
    });

    $router->map('GET', 'statussen/', function () use (&$statusMeldingController, $requestBody) {
        $statusMeldingController->handleGetAll($requestBody);
    });

    $router->map('GET', 'statussen/[i:id]', function ($id) use(&$statusMeldingController){
        $statusMeldingController->handleGetById($id);
    });

    $router->map('POST', 'statussen/', function () use (&$statusMeldingController, $requestBody) {
        $statusMeldingController->handleAddStatusMelding($requestBody);
    });

    $router->map('PUT', 'statussen/', function () use (&$statusMeldingController, $requestBody) {
        $statusMeldingController->handleUpdateStatusMelding($requestBody);
    });

    $router->map('DELETE', 'statussen/[i:id]', function ($id) use (&$statusMeldingController) {
        $statusMeldingController->handleDeleteStatusMelding($id);
    });

    $match = $router->match();
    if ($match && is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        echo 'Something went wrong with the routing.';
    }

} catch (\Exception $e) {
    print('Connection failed ' . $e);
}