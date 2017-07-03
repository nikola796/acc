<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 13.4.2017 г.
 * Time: 13:32 ч.
 */

namespace app\models;

use App\Core\App;
use Connection;
use PDO;
use PDOException;

class Post
{

    private $db;

    public function __construct()
    {
        $conf = App::get('config');

        $this->db = Connection::make($conf['database']);
    }

    public function getAllPost()
    {

        $stmt = $this->db->prepare('SELECT p.*, group_concat(f.id separator "; ") as file_id, group_concat(f.label separator "; ") as label,group_concat(f.original_filename separator "; ") as file_name, nc.name as folder, u.name as username FROM posts as p
                                              LEFT JOIN files as f on (p.id=f.post_id) 
                                              LEFT JOIN '.NESTED_CATEGORIES.'  AS nc ON (p.directory=nc.category_id) 
                                              LEFT JOIN users as u ON (p.added_from=u.id) GROUP BY p.id');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function updatePost($params = array())
    {
        //echo '<pre>' . print_r($params, true) . '</pre>';

        $existing_files = array_splice($params, 3, 1);

        $removed_files = array_splice($params, 3, 1);

        $removed_files_name = array_splice($params, 3, 1);
        //echo '<pre>' . print_r($removed_files_name['removed_files_name'], true) . '</pre>';die();
        if(($removed_files_name['removed_files_name'][0])){
            foreach ($removed_files_name['removed_files_name'] as $v){
                foreach($v as $vv){
                    $vvv[] = $vv['original_filename'];
                };
        }

}



        // $removed_files_names = array('removed_files_name' => array(' index.txt'));
        //die(implode(', ', $removed_files_names['removed_files_name']));
        // echo '<pre>' . print_r($removed_files_names, true) . '</pre>';die();
        $department = App::get('database')->getFolderDepartment($params['folder']);
        //echo '<pre>' . print_r($department, true) . '</pre>';die();
        $ex_files = $existing_files['existing_file'];

        $rm_files = $removed_files['removed_files'];
        //echo '<pre>' . print_r($rm_files, true) . '</pre>';die();
        if (isset($_FILES['userfile']) || $ex_files != 0) {
            $attached = 1;

        } else {
            $attached = 0;
        }

        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare('UPDATE posts set post = :post, attachment = ' . $attached . ', directory = :folder, department = ' . $department . ', added_from = ' . $_SESSION['user_id'] . ' WHERE id = :post_id');
            $stmt->execute($params);
            $resp = $stmt->rowCount();

            $response = array();
           //if ($resp > 0) {
                $response['succss_update_post'] .= 'Успешно обновихте Вашия пост';
           // }

            if ($rm_files != 0) {

                //$arr = explode(', ', $rm_files);
                $file = new File();
                $file->deleteFile($rm_files);
               // $stmt = $this->db->prepare('DELETE FROM files WHERE id  IN (' . $rm_files . ') AND  post_id = ?');
               // $stmt->execute(array($params['post_id']));


            }

            if (isset($_FILES['userfile'])) {
                $file = new File();
                //dd($department);
                //$response += $file->process_uploaded_file();
                $response += $file->fileUpload2($params['post_id'], array('act' => 'edit', 'department_id' => $department));
            }

            // return $stmt->rowCount();
            $this->db->commit();
           // die(var_dump($removed_files_name));
            //echo '<pre>' . print_r($removed_files_name['removed_files_name'], true) . '</pre>';
            if ($vvv ) {

                //echo '<pre>' . print_r($removed_files_name['removed_files_name'], true) . '</pre>';
                 //die(var_dump($removed_files_name['removed_files_name']));
                $response['removed_files_are'] = 'Успешно премахнахте файл';
                if(count($vvv) > 1 ){
                    $response['removed_files_are'] .= 'ове: ' . implode(', ', $vvv);
                } else{
                    $response['removed_files_are'] .= ': ' . implode(', ', $vvv);
                }
                //die(var_dump(strpos($removed_files_name['removed_files_name'], ',')));
//                if (strpos($removed_files_name['removed_files_name'], ',') === false) {
//                    $response['removed_files_are'] .= ': ';
//
//                } else {
//                    $response['removed_files_are'] .= 'ове: ';
//                }

               // $response['removed_files_are'] = $removed_files_name['removed_files_name'];

                //$response['removed_files_are'] .= ' '. implode(', ', $removed_files_names['removed_files_name']);
//    //echo '<pre>' . print_r($removed_files_names, true) . '</pre>';die();
//    $response['removed_files_are'] .= implode(', ', $removed_files_names['removed_files_name']);
            }

            //echo '<pre>' . print_r($response, true) . '</pre>';die();
            $_SESSION['update_post'] = $response;
            redirect('posts');
        } catch (PDOException $ex) {
            $this->db->rollBack();
            echo $ex->getMessage();
        }
    }

    public function deletePost($post_id)
    {
        try{
            $this->db->beginTransaction();

            $stmt = $this->db->prepare('DELETE FROM posts WHERE id = ?');
            $stmt->execute(array($post_id));
            $row_count = $stmt->rowCount();

            $path = realpath('core/files') . DIRECTORY_SEPARATOR;
            $del_files = 0;

            $stmt = $this->db->prepare('SELECT stored_filename FROM files WHERE post_id = ?');
            $stmt->execute(array($post_id));
            $row = $stmt->fetchAll(PDO::FETCH_CLASS);

            $stmt = $this->db->prepare('DELETE FROM files WHERE post_id = ?');

            foreach ($row as $file){
                if (unlink($path . $file->stored_filename)) {

                    $del_files += 1;
                }
            }

            if(count($row) == $del_files){
                $stmt->execute(array($post_id));
            }
            //dd($del_files);
            //$stmt->execute(array($post_id));
           // $file_count = $stmt->rowCount();
            $this->db->commit();

            return array('del_post' => $row_count, 'del_file' => $del_files);
        }catch (PDOException $ex){
            $this->db->rollBack();
            echo $ex->getMessage();
        }


    }

}