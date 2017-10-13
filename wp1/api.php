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
    //var_dump($dbinfo['password']);
    $pdo = new PDO($dbinfo['dsn'], $dbinfo['username'], $dbinfo['password']);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $jsonView = new JsonView();

    $locatieRepository = new LocatiePDORepository($pdo);
    $locatieController = new LocatieController($locatieRepository, $jsonView);

    $router = new AltoRouter();
    $router->setBasePath('/');

    // locatie mapping
     $router->map('GET', '/', function () {
       require   'src/view/JsonView.php';
    });

    $router->map('GET', 'locaties/', function () use (&$locatieController, $requestBody) {
        $locatieController->handleGetAll($requestBody);
    });

    $router->map('GET', 'locaties/[i:id]', function ($id) use (&$locatieController) {
        $locatieController->handleGetById($id);
    });

    $router->map('POST', 'locaties',
        function () use ($locatieController, $requestBody) {
        $locatieController->handleAddLocatie($requestBody);
        }
    );

    $router->map('PUT', 'locaties',
        function () use (&$locatieController, $requestBody) {
            $locatieController->handleUpdateLocatie($requestBody);
        }
    );

    $router->map('DELETE', 'locaties/delete/[i:id]', function ($id) use (&$locatieController) {
        $locatieController->handleDeleteLocatie($id);
    });

    $router->map(
        'GET',
        'persons/[i:id]',
        function ($id) {
            echo $id;
        }
    );

    $match = $router->match();
    if ($match && is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        echo 'oops';//   http_response_code(500);
    }
    // Silly
//    $app->command('locaties', function (LocatieRepository $repository, View $view) {
//        $locaties = $repository->getAll();
//        foreach ($locaties as $locatie) {
//            $data['id'] = $locatie->getId();
//            $data['name'] = $locatie->getNaam();
//            print($view->show($data));
//        }
//    });
//    $app->run();

} catch (\Exception $e) {
    print($e);
}