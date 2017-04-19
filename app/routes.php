<?php

$router->get('', array('PagesController', 'home'));

$router->get('Документи', array('App\Controllers\DocumentsController', 'getIndex'));

$router->get('documents/{id}', array('App\Controllers\DocumentsController', 'show'));

//$router->get('files/{id}', array('App\Controllers\FilesController', 'index'));

$router->get('Важно', array('App\Controllers\FilesController', 'important'));


// TEST ROUTES
// TODO DELETE AFTER TESTS ENDS

$router->get('admin', function(){
    return view('form');
});

$router->get('admin2',  array('App\Controllers\DocumentsController', 'admin2'));

$router->get('test', array('App\Controllers\DocumentsController', 'getTestIndex'));

$router->get('Документи/{dep}', array('App\Controllers\DocumentsController', 'showTest'));

$router->get('bb_test', array('App\Controllers\DocumentsController', 'bb'));

$router->post('bb_test', array('App\Controllers\DocumentsController', 'bb_store'));

$router->get('{folder}', array('App\Controllers\DocumentsController', 'getFolder'));

$router->get('{folder}/Файлове/{id}', array('App\Controllers\FilesController', 'indexTest'));

$router->post('admin', array('App\Controllers\DocumentsController', 'admin_store'));

$router->post('admin2', array('App\Controllers\DocumentsController', 'admin_store2'));

