<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 10.3.2017 г.
 * Time: 17:07 ч.
 */

namespace App\Controllers;


use App\Core\App;

class FilesController
{

    /**
     * GET ALL FILES
     * @param $id
     * @return mixed
     */
    public function index($id)
    {
        $files = App::get('database')->selectFiles('files', $id);

        return view('files', compact('files'));

    }

    /**
     * GET FILES FOR CURRENT DIRECTORY
     * @param $current_folder
     * @param $id
     * @return mixed
     */
    public function indexTest($department, $parent_folder, $folder = null)
    {
        if ($folder) {
            $folder_id = App::get('database')->getId('category_id', $folder, NESTED_CATEGORIES, $department, $parent_folder);
            $current_folder = $folder;
        } else {
            $folder_id = App::get('database')->getId('category_id', $parent_folder, NESTED_CATEGORIES, $department);
            $current_folder = $parent_folder;
        }

        $department_name = App::get('database')->getFolderName($folder_id[0]->dep);;
        $folders = App::get('database')->selectSubFolders($folder_id[0]->category_id);

        if (empty($folders)) {
            $folders = App::get('database')->getDepartment($folder_id[0]->category_id);

        }

        $posts = App::get('database')->getPosts(array('department' => $folders[0]->dep, 'directory' => $folder_id[0]->category_id));

        $files = App::get('database')->selectAllFiles(array('dep' => $folders[0]->dep, 'directory' => $folder_id[0]->category_id));

        return view('files', compact('folders', 'files', 'current_folder', 'posts', 'department_name', 'parent_folder'));

    }


    /**
     * SHOW FILE BY ID
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $files = App::get('database')->selectFiles('files', $id);

        return view('files', compact('files'));

    }

    /**
     * ALL DOCUMENTS FROM IMPORTANT SPACE
     * @return mixed
     */
    public function important()
    {

        $important_documents = App::get('database')->selectAll('important');

        return view('important', compact('important_documents'));

    }

    /**
     * DOWNLOAD FILE
     * @param $stored_name
     * @param $real_name
     */
    public function downloadFile($stored_name, $real_name)
    {
        $file = realpath('core'. DIRECTORY_SEPARATOR .'files') . DIRECTORY_SEPARATOR . $stored_name;
        if (is_file($file)) {
            $filesize = filesize($file);

            header('Content-Description: File Transfer');
            header("Content-type: application/forcedownload");
            header("Content-disposition: attachment; filename=\"$real_name\"");
            header("Content-Transfer-Encoding: Binary");
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header("Content-length: " . $filesize);
            ob_clean();
            flush();
            readfile("$file");
            exit;
        } else {
            $_SESSION['file_error'] = 'Файлът не съществува!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }


    }


}