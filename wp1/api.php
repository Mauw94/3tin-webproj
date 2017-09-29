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
    $requestBody = file_get_contents("php://input");

    $dbinfo = json_decode(file_get_contents("dbconnection.json"), true);
    $pdo = new PDO($dbinfo['dsn'], $dbinfo['username'], $dbinfo['password']);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $jsonView = new JsonView();

    $locatieRepository = new LocatiePDORepository($pdo);
    $locatieController = new LocatieController($locatieRepository, $jsonView);

    $router = new AltoRouter();
    $router->setBasePath('/api.php');

    // locatie mapping
    $router->map('GET', '/locaties/[i:id]',
        function ($id) use ($locatieController) {
        $locatieController->handleGetById($id);
        }
    );

    $router->map('POST', '/locaties',
        function () use ($locatieController, $requestBody) {
        $locatieController->handleAddLocatie($requestBody);
        }
    );

    $router->map('PUT', '/locaties',
        function () use ($locatieController, $requestBody) {
            $locatieController->handleUpdateLocatie($requestBody);
        }
    );

    $router->map('DELETE', '/locaties/[i:id]',
        function ($id) use ($locatieController) {
        $locatieController->handleDeleteLocatie($id);
        }
    );

    $match = $router->match();
    if ($match && is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        echo '{404}';
    }

} catch (\Exception $e) {
    print($e);
}