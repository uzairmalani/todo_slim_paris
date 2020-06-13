<?php
declare (strict_types=1);
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;
use Slim\Routing\RouteContext;
include_once(dirname(__DIR__) . '/app/paris_modals.php');

return function(App $app){

	$app->get('/', function ($request, $response, $args)use($app) 
	{

		$database=Model::factory('item')->select_many('Id', 'description' , 'isdone' , 'itemPosition', 'listColor')
		->find_many();
		$items=Model::factory('item')->count() ? $database : [];
 		$renderer = new PhpRenderer(dirname(__DIR__) . '/template/');
    	return $renderer->render($response, "home.php", ['items' => $items]);
	})->setName('home');





	$app->post('/add', function($request, $response, $args) use($app)
	{

		$addId	=$request->getParsedBody();
		$des = $addId['desc'];
		$pos = $addId['pos'];
		$today = date("Y-m-d H:i:s"); 
      	$addedQuery = Model::factory('item')->create(array(
      	'description' => $des,
      	'isdone' => 0,
      	'createdt' => $today,
      	'itemPosition' => $pos,
      	'listColor' => 'colorBlue'
    	));
    	$addedQuery->save();	
		$routeParser = $app->getRouteCollector()->getRouteParser();
	    $url = $routeParser->urlFor('home');
		header('Location: '.$url);
  
    });


	$app->post('/done', function($request, $response, $args) use($app)
	{
		$doneId	=$request->getParsedBody();
		$mark_id = $doneId['doneItem'];
		$markQuery =Model::factory('item')->use_id_column('Id')->find_one($mark_id);
 		$markQuery->isdone = 1;
 		$markQuery->save();
 		return $response;
		// $routeParser = $app->getRouteCollector()->getRouteParser();
		// $url = $routeParser->urlFor('home');
		// header('Location: '.$url);
    
 	});


	$app->post('/del', function($request, $response, $args) use($app){
		$del_ID	=$request->getParsedBody();
		$delid = $del_ID['delItem'];
		$doneQuery =Model::factory('item')->use_id_column('Id')->find_one($delid);	
 		$doneQuery->delete();
 		return $response;
		// $routeParser = $app->getRouteCollector()->getRouteParser();
		// $url = $routeParser->urlFor('home');
		// header('Location: '.$url);
    });


	$app->post('/color', function($request, $response, $args) use($app)
	{
		$colors	=$request->getParsedBody();
		$color = $colors['Color'];
		$color_id = $colors['id'];
		$ChangeColour = Model::factory('item')->use_id_column('Id')->find_one($color_id);
 		$ChangeColour->listColor = $color;
 		$ChangeColour->save();
 		return $response;
		// $routeParser = $app->getRouteCollector()->getRouteParser();
		// $url = $routeParser->urlFor('home');
		// header('Location: '.$url);
  //   
 	});


	$app->post('/drag', function($request, $response, $args) use($app)
	{
		$drags	=$request->getParsedBody();
		$drag = $drags['position'];
		$i=1;
		$database=Model::factory('item')->create();
		$database->Drag($i, $drag);
		return $response;
		// $routeParser = $app->getRouteCollector()->getRouteParser();
		// $url = $routeParser->urlFor('home');
		// header('Location: '.$url);
    });
};