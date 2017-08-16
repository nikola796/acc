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

    /**
     * FoldersController constructor.
     */
    public function __construct()
    {
        $this->folder = new Folder();
    }

    /**
     * GET ALL FOLDERS
     * @return mixed
     */
    public function index()
    {
        $folders = $this->folder->selectFolders(NESTED_CATEGORIES);

        return view('admin/folders', compact('folders'));
    }

    /**
     * GET ALL FOLDERS WITH AJAX
     */
    public function index_ajax()
    {
        $this->folder->getFoldersAjax();
    }

    /**
     * STORE FOLDER
     */
    public function store()
    {
        //dd($_POST);
        $folder_name = trim($_POST['name']);
        $parent_id = intval($_POST['parent']);
        $data = array('folder_name' => $folder_name, 'parent_id' => $parent_id, 'sort_number' => intval($_POST['new_sort_number']));
        if ($parent_id === 0) {
            $data['department'] = 0;
            echo Folder::createFolder($data);
        } else if ($parent_id > 0) {
            $department_id = App::get('database')->getFolderDepartment($parent_id);
            $data['department'] = $department_id;
            echo Folder::createFolder($data);
        }

    }

    /**
     * UPDATE FOLDER
     */
    public function update()
    {
        $data = array('name' => trim($_POST['name']), 'old_name' => trim($_POST['old_name']), 'folder_id' => intval($_POST['folder_id']), 'old_parent' => intval($_POST['parent_id']), 'new_parent' => intval($_POST['parent']));
        $new_sort_number = intval($_POST['new_sort_number']);
        $old_sort_number = intval($_POST['old_sort_number']);
        if ($new_sort_number != $old_sort_number) {
            $data['new_sort_number'] = $new_sort_number;
            $data['old_sort_number'] = $old_sort_number;
        }

        if ($data['old_parent'] == $data['new_parent']) {

            $result = $this->folder->updateFolderName($data);
            if ($result == 1) {
                echo 'success';
            } else {
                echo $result;
            }

        } else if ($data['folder_id'] == $data['new_parent']) {
            echo 'Не може да сложите папката в себе си';
        } else if ($data['old_parent'] != $data['new_parent']) {
            $result = $this->folder->updateFolderPlace($data);
            echo $result;
        }

    }

    /**
     * DELETE FOLDER BY ID
     * @param $id
     */
    public function delete($id)
    {
        if ($_POST['del'] == 'all') {
            $res = $this->folder->deleteFoldersAndSubFolder(intval($id));
        } elseif ($_POST['del'] == 'only_folder') {
            $res = $this->folder->deleteOnlyFolder(intval($id));
        }
        echo $res;
    }

    /**
     * GET MAX SORT NUMBER FOR FOLDER
     */
    public function getSortNumbers()
    {
        $parent = intval($_POST['parent']);
        $res = $this->folder->getSortNumbers($parent);

        if (max($res) == null) {
            echo 0;
        } else {
            echo max($res);
        }

    }
}