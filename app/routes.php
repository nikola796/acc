<?php

$router->get('', array('PagesController', 'home'));

$router->get('Документи', array('App\Controllers\DocumentsController', 'getIndex'));

$router->get('documents/{id}', array('App\Controllers\DocumentsController', 'show'));



$router->get('recover', array('app\controllers\AuthController', 'recover'));

$router->get('reset_password?{tok}', array('app\controllers\AuthController', 'reset_password'));

//$router->get('files/{id}', array('App\Controllers\FilesController', 'index'));

$router->get('Важно', array('App\Controllers\FilesController', 'important'));

$router->get('files?{stored_filename}&{original_filename}', array('App\Controllers\FilesController', 'downloadFile'));


$router->get('test', array('App\Controllers\DocumentsController', 'getTestIndex'));

$router->get('Документи/{dep}', array('App\Controllers\DocumentsController', 'showTest'));

$router->get('Документи/{dep}?filaname', array('App\Controllers\DocumentsController', 'showGet'));

$router->get('bb_test', array('App\Controllers\DocumentsController', 'bb'));

$router->get('admin/edit', function(){
    return view('admin/lang');
});

$router->get('{folder}/Файлове/{id}', array('App\Controllers\FilesController', 'indexTest'));

$router->get('{folder}', array('App\Controllers\DocumentsController', 'getFolder'));

$router->get('admin/table', array('app\controllers\AdminsController', 'table'));

$router->get('admin/calendar', function(){
    return view('admin/calendar');
});


/***************** ADMIN GET ROUTES *************************************************************************/

$router->get('admin/important', array('app\controllers\ImportantController', 'index'),
    array('before' => 'auth'));

$router->get('admin/home', array('app\\controllers\\AdminsController', 'index'),
    array('before' => 'auth'));

$router->get('admin/profile', array('App\\Controllers\\UsersController', 'show'),
    array('before' => 'auth'));

$router->get('admin/users', array('app\\controllers\\AdminsController', 'users'),
    array('before' => 'auth'));

$router->get('admin/posts', array('app\\controllers\\AdminsController', 'posts'),
    array('before' => 'auth'));

$router->get('admin/logout',   array('app\controllers\AuthController', 'logout'));

//$router->get('admin2',  array('App\Controllers\DocumentsController', 'admin2'));

$router->get('admin/departments',  array('app\controllers\DepartmentsController', 'index'),
    array('before' => 'auth'));

$router->get('admin/folders',  array('app\\controllers\\FoldersController', 'index'),
    array('before' => 'auth'));




/****** POST ROUTES *****************************************************************************************/

$router->post('admin/table/get', array('app\controllers\AdminsController', 'tableGet'),
    array('before' => 'auth'));

$router->post('admin/users', array('app\\controllers\\AdminsController', 'createUser'),
    array('before' => 'auth'));

$router->post('admin/users/all', array('app\\controllers\\AdminsController', 'test_table'),
    array('before' => 'auth'));

$router->post('admin/users/delete/{id}', array('app\\controllers\\AdminsController', 'deActivateUser'),
    array('before' => 'auth'));

$router->post('auth', array('app\controllers\AuthController', 'login'));

$router->post('view-post', array('App\Controllers\DocumentsController', 'previewPost'));

$router->post('admin/important', array('app\controllers\ImportantController', 'newDocument'),
    array('before' => 'auth'));

$router->post('parser', function(){
    return view('parser');
});

$router->post('admin/create-folder', array('App\Controllers\DocumentsController', 'createFolder'),
    array('before' => 'auth'));

$router->post('admin', array('App\Controllers\DocumentsController', 'admin_store'));

$router->post('admin2', array('App\Controllers\DocumentsController', 'admin_store2'));

$router->post('admin/posts', array('App\Controllers\DocumentsController', 'admin_store2'),
    array('before' => 'auth'));

$router->post('bb_test', array('App\Controllers\DocumentsController', 'bb_store'));

$router->post('admin/delete-post', array('App\Controllers\DocumentsController', 'delete_post'),
    array('before' => 'auth'));

$router->post('admin/delete-file', array('App\Controllers\DocumentsController', 'delete_file'),
    array('before' => 'auth'));

$router->post('admin/departments',  array('app\controllers\DepartmentsController', 'index_ajax'),
    array('before' => 'auth'));

$router->post('admin/new-department',  array('app\controllers\DepartmentsController', 'store'),
    array('before' => 'auth'));

$router->post('admin/edit-department',  array('app\controllers\DepartmentsController', 'update'),
    array('before' => 'auth'));

$router->post('admin/delete-department?{id}',  array('app\controllers\DepartmentsController', 'delete'),
    array('before' => 'auth'));

$router->post('admin/delete-folder?{id}',  array('app\controllers\FoldersController', 'delete'),
    array('before' => 'auth'));

$router->post('admin/folders',  array('app\\controllers\\FoldersController', 'index_ajax'),
    array('before' => 'auth'));

$router->post('admin/edit-folder',  array('app\\controllers\\FoldersController', 'update'),
    array('before' => 'auth'));

$router->post('admin/new-folder',  array('app\\controllers\\FoldersController', 'store'),
    array('before' => 'auth'));

$router->post('admin/profile', array('App\\Controllers\\UsersController', 'changePassword'),
    array('before' => 'auth'));

$router->post('reset_password', array('app\controllers\AuthController', 'forgot_password'));

$router->post('new_password', array('App\\Controllers\\UsersController', 'new_password'));

/***************** TEST FOR FILTER ROUTES ******************************************************************************/
$router->filter('auth',
//    function(){
//
//   if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] != 1){
//       redirect(uri());
//       return false;
//   }
//}
    array('app\controllers\AuthController', 'session_start')
);

$router->filter('authComplete', function(){
    redirect(uri().'admin');
});

$router->get('/user/{name}', function($name){
    return 'Hello ' . $name;
}, array('before' => 'auth', 'after' => 'authComplete'));

