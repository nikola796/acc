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
            $dep_id = App::get('database')->getDepartment($folder_id[0]->category_id);

            $posts = App::get('database')->getPosts(array('department' => $dep_id[0]->dep, 'directory' => $folder_id[0]->category_id));

            $files = App::get('database')->selectAllFiles(array('dep' => $dep_id[0]->dep, 'directory' => $folder_id[0]->category_id));

        } else{
            $posts = App::get('database')->getPosts(array('department' => $folders[0]->dep, 'directory' => $folder_id[0]->category_id));

            $files = App::get('database')->selectAllFiles(array('dep' => $folders[0]->dep, 'directory' => $folder_id[0]->category_id));

        }
        $allCategories = App::get('database')->selectChildren($folder_id[0]->category_id);

        $allCategoriesIDS = array_column($allCategories, 'category_id');

        //echo '<pre>'.print_r($allCategoriesIDS). '</pre>'; die();
        $totalExpense = App::get('database')->getTotals(array('department' => $folder_id[0]->parent_id, 'type' => 0), $allCategoriesIDS);

        $totalRevenue = App::get('database')->getTotals(array('department' => $folder_id[0]->parent_id, 'type' => 1), $allCategoriesIDS);

        $allData = array_merge($folders, $files, $posts);
        return view('files', compact('allData','totalExpense','totalRevenue', 'files', 'current_folder', 'posts', 'department_name', 'parent_folder'));

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
        $file = realpath(FILES_FOLDER) . DIRECTORY_SEPARATOR . $stored_name;
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

    public function checkFileErrors()
    {
        /**  CHECK FOR ERRORS ON UPLOAD FILES **/
        foreach ($_FILES['userfile']['error'] as $k => $error) {
            if ($error > 0) {
                $errors[$k] = $error;
            } else {
                if (isset($_POST['label'][$k]) && strlen(trim($_POST['label'][$k])) > 0) {
                    //$files = $_FILES['userfile'][$k];
                    $files_label[$k] = $_POST['label'][$k];
                }
            }
        }

        /** IF NO ERRORS CONTINUE **/
        if (count($errors) === 0) {
            /** IF FILE GOT A LABEL CONTINUE **/
            if (count($_FILES['userfile']['error']) === count($files_label)) {
return $output = array('success' => 'File is OK');
            } else {
                // NO DESCRIPTION FOR SOME FILE
                $output = array('error' => 'Не сте добавили описание на файл');
            }

        } else {
            // CHECK FOR TYPE OF ERROR
            $output = $this->uploadedFileErrorCheck($errors);

        }
        return $output;
    }

    /**
     * @param array $errors
     * @return mixed
     * @internal param array $test
     * @internal param $output
     */
    private function uploadedFileErrorCheck($errors = array())
    {
        $output = array();
        foreach ($errors as $error) {

            switch ($error) {

                case 1:
                    $output['error'] = 'Файлът, който се опитвате да прикачите е с прекалено голям размер. Максимално допустим е файл с големина до 20Mb';
                    break;
                case 2:
                    $output['error'] = 'Файлът, който се опитвате да прикачите е с прекалено голям размер. Максимално допустим е файл с големина до 20Mb';
                    break;
                case 3:
                    $output['error'] = 'Прикаченият файл е само частично добавен!';
                    break;
                case 4:
                    $output['error'] = ' Не сте прикачили файл!';
                    break;
                case 6:
                    $output['error'] = ' Липсва временната папка за прикачване!.';
                    break;
                case 7:
                    $output['error'] = ' Грешка при опит да се пише на диска.';
                    break;
                case 8:
                    $output['error'] = ' PHP спря качването на файла.';
                    break;
                default:
                    $output['error'] = 'Неясна грешка при прикачнаве на файл. Моля опитайте отново.';
            }
        }


        return $output;
    }


}
