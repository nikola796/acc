<?php
session_start();
$router->get('', array('PagesController', 'home'));

$router->get('Документи', array('App\Controllers\DocumentsController', 'getIndex'));

$router->get('documents/{id}', array('App\Controllers\DocumentsController', 'show'));

//$router->get('files/{id}', array('App\Controllers\FilesController', 'index'));

$router->get('Важно', array('App\Controllers\FilesController', 'important'));

// TEST ROUTES
// TODO DELETE AFTER TESTS ENDS

$router->get('admin', array('app\\controllers\\AdminsController', 'index'),
    array('before' => 'auth', 'after' => 'authComplete'));

$router->get('logout',   array('app\controllers\AuthController', 'logout'));

$router->get('admin2',  array('App\Controllers\DocumentsController', 'admin2'));

$router->get('test', array('App\Controllers\DocumentsController', 'getTestIndex'));

$router->get('Документи/{dep}', array('App\Controllers\DocumentsController', 'showTest'));

$router->get('bb_test', array('App\Controllers\DocumentsController', 'bb'));

$router->get('parser', function(){
    return view('parser');
});

$router->get('ckeditor', function(){
    return view('ckeditor');
});

$router->get('{folder}/Файлове/{id}', array('App\Controllers\FilesController', 'indexTest'));

$router->get('{folder}', array('App\Controllers\DocumentsController', 'getFolder'));


/****** POST ROUTES *****************************************************************************************/
$router->post('auth', array('app\controllers\AuthController', 'login'));

$router->post('view-post', array('App\Controllers\DocumentsController', 'previewPost'));



$router->post('parser', function(){
    return view('parser');
});

$router->post('create-folder', array('App\Controllers\DocumentsController', 'createFolder'));

$router->post('admin', array('App\Controllers\DocumentsController', 'admin_store'));

$router->post('admin2', array('App\Controllers\DocumentsController', 'admin_store2'));

$router->post('bb_test', array('App\Controllers\DocumentsController', 'bb_store'));



/***************** TEST FOR FILTER ROUTES ******************************************************************************/
$router->filter('auth', function(){

   if(!isset($_SESSION['is_logged'])){
       redirect(uri());
       return false;
   }
});

$router->filter('authComplete', function(){
    redirect(uri().'admin');
});

$router->get('/user/{name}', function($name){
    return 'Hello ' . $name;
}, array('before' => 'auth', 'after' => 'authComplete'));