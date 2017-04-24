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
require_once 'core/init.inc.php';

//$options = @parse_ini_file('core/BBCodeParser.ini');
//$parser = new HTML_BBCodeParser2($options);

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
    header("Location: {$path}");
}

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

function dd($data){
    echo '<pre>';
    die(var_dump($data));
    echo '</pre>';
}

function parser()
{
    $config = parse_ini_file('core/BBCodeParser2.ini', true);
    $options = $config['HTML_BBCodeParser2'];
    $parser = new HTML_BBCodeParser2($options);
    return $parser;
}

