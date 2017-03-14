<?php

$router->get('', array('PagesController', 'home'));

$router->get('documents', array('App\Controllers\DocumentsController', 'getIndex'));

$router->get('documents/{id}', array('App\Controllers\DocumentsController', 'show'));

$router->get('files/{id}', array('App\Controllers\FilesController', 'index'));

$router->get('important', array('App\Controllers\FilesController', 'important'));

