<?php

class QueryBuilder
{

	protected $pdo;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function selectAll($table)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM {$table} WHERE active = 1");
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

	public function insert($table, $params)
	{


        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)',  
        			
        			$table, 
        			
        			implode(', ', array_keys($params)), 
        			
        			':' . implode(', :', array_keys($params))
        			
        			);

       // return $params['name'];

try{

	$stmt = $this->pdo->prepare($sql);
	//var_dump($statement->queryString);

	$stmt->execute($params);

	//return $stmt->rowCount();

} catch (Exception $e) {

	die($e->getMessage());

}
		
		

	}

}