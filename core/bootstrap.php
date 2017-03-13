<?php

use App\Core\App;

App::bind('config', require 'config.php');

//$app = array();
//
//$app['config'] = require 'config.php';


//require 'core/Router.php';
//
//require 'core/Request.php';
//
//require 'core/database/Connection.php';
//
//require 'core/database/QueryBuilder.php';

$conf = App::get('config');
App::bind('database', new QueryBuilder(

	Connection::make($conf['database'])

));

function view($name, $data = array())
{

    extract($data);

    return require 'app/views/'.$name.'.view.php';

}

function redirect($path)
{
    header("Location: /{$path}");
}