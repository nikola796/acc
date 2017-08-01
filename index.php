<?php
//phpinfo();die();
require 'vendor/autoload.php';

require 'core/bootstrap.php';

use App\Core\Request;

function processOutput($response){
    echo json_encode($response);
}

$router = new Phroute\RouteCollector(new Phroute\RouteParser);
//var_dump($router);die();
require 'app/routes.php';

$dispatcher = new Phroute\Dispatcher($router);

try {

    $response = $dispatcher->dispatch(Request::method(), Request::uri());

} catch (Phroute\Exception\HttpRouteNotFoundException $e) {

   // var_dump($e);
   // die();
//header('Location: '. url().'404');
    return view('404');
exit();
}

//processOutput($response);

