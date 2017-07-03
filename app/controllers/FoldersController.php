<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 13.06.2017
 * Time: 14:59 ч.
 */

namespace app\controllers;


use App\Core\App;
use app\models\Folder;

class FoldersController
{
    
    private $folder;
    
    public function __construct()
    {
        $this->folder = new Folder();
    }

    public function index()
    {
        //$folders = App::get('database')->selectFolders(NESTED_CATEGORIES);
        $folders = $this->folder->selectFolders(NESTED_CATEGORIES);

        return view('admin/folders', compact('folders'));
    }

    public function index_ajax()
    {
        $this->folder->getFoldersAjax();
    }

    public function store()
    {
        $folder_name = trim($_POST['name']);
        $parent_id = intval($_POST['parent']);
        $data = array('folder_name' => $folder_name, 'parent_id' => $parent_id);
        if($parent_id === 0){
            $data['department'] = 0;
            echo Folder::createFolder($data);
        } else if($parent_id > 0){
            $department_id = App::get('database')->getFolderDepartment($parent_id);
            $data['department'] = $department_id;
            echo Folder::createFolder($data);
        }

    }

    public function update()
    {
        //echo '<pre>' . print_r($_POST, true) . '</pre>';die();
        $data = array('name' => trim($_POST['name']), 'folder_id' => intval($_POST['folder_id']), 'old_parent' => intval($_POST['parent_id']), 'new_parent' => intval($_POST['parent']));

        if($data['old_parent'] == $data['new_parent']){
        $result = $this->folder->updateFolderName($data);
            echo $result;
    }
        else if($data['folder_id'] == $data['new_parent']){
            echo 'Не може да сложите папката в себе си';
        }
        else if($data['old_parent'] != $data['new_parent']){
            $result = $this->folder->updateFolderPlace($data);
            echo $result;
        }

    }

    public function delete($id)
    {

        if($_POST['del'] == 'all'){
           $res = $this->folder->deleteFoldersAndSubFolder(intval($id));
        } elseif ($_POST['del'] == 'only_folder'){
            $res = $this->folder->deleteOnlyFolder(intval($id));
        }

        echo $res;
    }
}