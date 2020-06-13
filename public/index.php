<?php


use DI\Container;
use Slim\Factory\AppFactory;

require dirname(__DIR__) . '/vendor/autoload.php';

include_once(dirname(__DIR__) . '/app/connection.php');

include_once(dirname(__DIR__) . '/app/paris_modals.php');
include_once(dirname(__DIR__) . '/app/modal.php');








// Create Container using PHP-DI
 $container = new Container();
 $container->set('database', function () {
     return new Database();
});
AppFactory::setContainer($container);
 $app = AppFactory::create();
$app->setBasePath("/Todo_slim_paris/public");
// $app->get('/', function (Request $request, Response $response, $args) {
//     $response->getBody()->write("Hello world!");
//     return $response;

$routes = require dirname(__DIR__) . '/app/routes.php';;
$routes($app);

$app->run();