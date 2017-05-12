<?php

class QueryBuilder
{

    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getParents()
    {
        $stmt = $this->pdo->prepare("SELECT node.category_id, node.name, (COUNT(parent.name) - 1) AS depth
                                    FROM nested_category AS node,nested_category AS parent
                                    WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                    GROUP BY node.name HAVING COUNT(parent.name) = 1
                                    ORDER BY node.lft;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function getDirsTest($id)
    {
        $stmt = $this->pdo->prepare();

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectAll($table)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$table} WHERE active = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectFolders($table)
    {
        $stmt = $this->pdo->prepare('SELECT CONCAT( REPEAT( "* ", COUNT( parent.name ) -1) , node.name) AS name, node.category_id
                                              FROM ' . $table . ' AS node, ' . $table . ' AS parent
                                              WHERE node.lft
                                              BETWEEN parent.lft
                                              AND parent.rgt
                                              GROUP BY node.name
                                              ORDER BY node.lft');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectDirectories($id)
    {
//        $sql = "SELECT * FROM {$table} WHERE {$column}  = {$id}";
//        return $sql;
        $stmt = $this->pdo->prepare("SELECT d.id,d.name,dp.name as dep FROM `directories` as d left join `departments` as dp ON (d.department = dp.id) WHERE department = ? and d.active = 1");
        $stmt->execute(array(0 => $id));
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectFiles($table, $id)
    {

        $stmt = $this->pdo->prepare("SELECT {$table}.*, d.name as dir FROM {$table} LEFT JOIN directories as d ON (directory =  d.id) WHERE directory = ? ");
        $stmt->execute(array(0 => $id));
        return $stmt->fetchAll(PDO::FETCH_CLASS);

    }

    public function selectAllFiles($params)
    {

        $stmt = $this->pdo->prepare("SELECT * FROM files WHERE directory = :directory AND department_id = :dep ");
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_CLASS);

    }

    public function insert($table, $params)
    {


        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)',

            $table,

            implode(', ', array_keys($params)),

            ':' . implode(', :', array_keys($params))

        );

        // return $params['name'];

        try {

            $stmt = $this->pdo->prepare($sql);
            //var_dump($statement->queryString);

            $stmt->execute($params);

            //return $stmt->rowCount();

        } catch (Exception $e) {

            die($e->getMessage());

        }


    }

    public function getTestFolders($dep)
    {
        $stmt = $this->pdo->prepare('SELECT node.category_id,node.name, (COUNT(parent.name) - 1) AS depth
FROM nested_category AS node,
  nested_category AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt AND parent.rgt < 20
GROUP BY node.name
  HAVING COUNT(parent.name) = 1
ORDER BY node.lft;');

        $stmt->execute(array(0 => $dep));
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectAllFolders($dep)
    {
        //  $stmt = $this->pdo->prepare("call intranet.GetFolders({$dep});");
//die(var_dump($dep));
        $stmt = $this->pdo->query("SELECT @Category_id := category_id FROM nested_categorys WHERE dep = {$dep} AND parent_id = 0");
        $stmt = $this->pdo->prepare("SELECT * FROM nested_categorys WHERE dep = ? AND parent_id = @Category_id");
        $stmt->execute(array($dep));
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectSubFolders($parent)
    {
        //  $stmt = $this->pdo->prepare("call intranet.GetFolders({$dep});");
//die(var_dump($dep));
        $stmt = $this->pdo->prepare("SELECT * FROM `nested_categorys` where parent_id = ?");
        $stmt->execute(array($parent));
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function getId($id, $name, $table)
    {

        $stmt = $this->pdo->prepare("SELECT {$id} from {$table} where name = :name");
        $stmt->execute(array('name' => $name));
        return $stmt->fetchAll(PDO::FETCH_CLASS);

    }

    public function getFolderDepartment($id)
    {

        $stmt = $this->pdo->prepare("SELECT dep from nested_categorys where category_id = :id");
        $stmt->execute(array('id' => $id));
        $res = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $res[0]->dep;
    }

    public function insertPost($params)
    {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO posts (post,attachment,directory,department,added_from,added_when) VALUES(:text, :file, :directory_id, :department_id, '.$_SESSION['user_id'].', ' . time() . ')');

            $stmt->execute($params);

            return $this->pdo->lastInsertId();;

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function getAllPosts()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM posts");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function getUsersFolders($dep, $folder = null)
    {

        $sql = 'SELECT * FROM mynested_category WHERE  dep = ?';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($dep));

        return $stmt->fetchAll(PDO::FETCH_CLASS);

    }

    public function getDepartmentFolderId($dep)
    {
        $stmt = $this->pdo->prepare('SELECT category_id FROM nested_categorys WHERE dep = ? AND parent_id = 0');
        $stmt->execute(array($dep));

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function getPosts($values = array())
    {
        //die(var_dump($values));

        $sql = 'SELECT * FROM posts WHERE  department = :department AND directory = ';

        if (!$values['directory']) {
            $sql .= '0';
        } else {
            $sql .= ':directory';

        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($values);

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function saveFile($file = array())
    {
        $sql = 'INSERT INTO files (name, label, added_from, added_when, department_id, directory, post_id)
                  VALUES(?, ?, '.$_SESSION['user_id'].', ' . time() . ', ?, ?, ?)';

        $stmt = $this->pdo->prepare($sql);

        foreach ($file as $f) {
            $stmt->execute(array($f['name'], $f['label'], $f['dep_id'], $f['folder'], $f['post_id']));
        }
        //$stmt->execute($file);

        return $stmt->rowCount();
    }
}