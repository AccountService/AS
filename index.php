<?php
include "vendor/autoload.php";
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Session\Session;




$request = Request::createFromGlobals();

$routes = new RouteCollection();
$routes->add('keys', new Route('/keys', array('controller' => 'Index', 'action'=>'key')));
$routes->add('index', new Route('/', array('controller' => 'Index', 'action'=>'index')));
$routes->add('reg', new Route('/reg', array('controller' => 'Index', 'action'=>'reg')));
$routes->add('cancel', new Route('/cancel', array('controller' => 'Index', 'action'=>'cancel')));
$routes->add('mark', new Route('/mark', array('controller' => 'Index', 'action'=>'mark')));
$routes->add('discard', new Route('/discard', array('controller' => 'Index', 'action'=>'discard')));
$routes->add('buy', new Route('/buy', array('controller' => 'Index', 'action'=>'buy')));
$routes->add('get', new Route('/get', array('controller' => 'Index', 'action'=>'get')))


 ?>
<html >
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" charset="utf-8" />
    <link rel="stylesheet" href="style/css/style.css">



</head>




<?php
$context = new RequestContext();
// this is optional and can be done without a Request instance
$context->fromRequest(Request::createFromGlobals());

$matcher = new UrlMatcher($routes, $context);
file_put_contents('/tmp/log', json_encode($request->getPathInfo()). "\n", FILE_APPEND);
try{
    $parameters = $matcher->match($request->getPathInfo());
    $controller = new $parameters['controller']($request);
    $action = "{$parameters['action']}Action";
    $response = $controller->$action();
    $response->send();
}catch(Exception $e){
    $response = new Response('Not Found', 404, array('Content-Type' => 'text/plain'));
    $response->send();
}


?>

