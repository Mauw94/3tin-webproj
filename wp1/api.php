<?php
require_once "vendor/autoload.php";

use view\JsonView;
use model\LocatiePDORepository;
use model\LocatieRepository;
use view\View;
use controller\LocatieController;

$container = require __DIR__ . '/src/app/container.php';
$app = new Silly\Application();
$app->useContainer($container, $injectWithTypeHint = true);
$pdo = null;

try {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $requestBody = file_get_contents("php://input");

    $dbinfo = json_decode(file_get_contents('dbconnection.json'), true);
    var_dump($dbinfo['password']);
    //$pdo = new PDO($dbinfo['dsn'], $dbinfo['username'], $dbinfo['password']);
    $pdo = new PDO("mysql:host=192.168.33.11;dbname=web-project3tin", "admin", "admin");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $jsonView = new JsonView();

    $locatieRepository = new LocatiePDORepository($pdo);
    $locatieController = new LocatieController($locatieRepository, $jsonView);

    $router = new AltoRouter();
    $router->setBasePath('/api.php/');

    // locatie mapping
    $router->map('GET', 'locaties/[i:id]',
        function ($id) use ($locatieController) {
        $locatieController->handleGetById($id);
        }
    );

    $router->map('POST', 'locaties',
        function () use ($locatieController, $requestBody) {
        $locatieController->handleAddLocatie($requestBody);
        }
    );

    $router->map('PUT', 'locaties',
        function () use ($locatieController, $requestBody) {
            $locatieController->handleUpdateLocatie($requestBody);
        }
    );

    $router->map('DELETE', 'locaties/[i:id]',
        function ($id) use ($locatieController) {
        $locatieController->handleDeleteLocatie($id);
        }
    );

    $match = $router->match();
    if ($match && is_callable($match['target'])) {
        call_user_func($match['target'], $match['params']);
    } else {
        header($_SERVER["SERVER_PROTOCOL"] . "404 Not Found");
    }
    // Silly
//    $app->command('locaties', function (LocatieRepository $repository, View $view) {
//        $locaties = $repository->getAll();
//        foreach ($locaties as $locatie) {
//            $data['id'] = $locatie->getId();
//            $data['name'] = $locatie->getName();
//            print($view->show($data));
//        }
//    });
//    $app->run();

} catch (\Exception $e) {
    print($e);
}