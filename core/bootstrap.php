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
require_once 'core/session.php';
//$options = @parse_ini_file('core/BBCodeParser.ini');
//$parser = new HTML_BBCodeParser2($options);

$conf = App::get('config');
App::bind('database', new QueryBuilder(

	Connection::make($conf['database'])

));

define("NESTED_CATEGORIES", "nested_categories_test");

function view($name, $data = array())
{

    extract($data);

    return require 'app/views/'.$name.'.view.php';

}

function redirect($path)
{
    header("Location: {$path}");
    exit();
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

function url()
{
    if ($_SERVER['SERVER_PORT'] != '443') {
        $URL = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
    } else {
        $URL = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
    }
    echo substr( $URL, 0,-9);
}

function uri(){

    return substr($_SERVER['PHP_SELF'], 0,-9);
}

function download_file($stored_filename, $original_filename){
    $file = realpath('core/files').DIRECTORY_SEPARATOR . $stored_filename;
    $filesize = filesize($file);
    header('Content-Description: File Transfer');
    header("Content-type: application/forcedownload");
    header('Content-disposition: attachment; filename="'.$original_filename.'"');
    header("Content-Transfer-Encoding: Binary");
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header("Content-length: ".$filesize);
    ob_clean();
    flush();
    readfile("$file");
    exit;
}

