<?php

class Database 
{
	protected $username = 'root';
	protected $password = '';
	protected $database = 'machine_test';
	protected $host = 'localhost';

	private $port = 3306;
	private $connection = false;
	private $query_str;

	protected $table;

	public function __construct(){
		$this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
	}

	private function executeRawQuery($sql){        
        // Write SQL statement into log
        $str = $sql . "  [". date("Y-m-d H:i:s") ."]" . PHP_EOL;
        file_put_contents("log.txt", $str, FILE_APPEND);
        if ($this->connection->connect_errno) {
			echo "Failed to connect to MySQL: " . $this->connection->connect_error;
			exit();
		}
        return $this->connection->query($sql);
        
    }
    private function buildWhere($condition){
    	$this->query_str = '';
    	if(count($condition)){
    		$string = implode(' and ', array_map(function($v, $k){
	    				return $k.' = \''.$v.'\'';
	    		}, $condition, array_keys($condition)
	    	));
	    	$this->query_str .= ' where ' . $string;
    	}
    }
    private function buildInsert($condition){
    	$this->query_str = '';
    	if(count($condition)){
    		$string = implode(', ', array_map(function($v, $k){
	    				return $k.' = \''.$v.'\'';
	    		}, $condition, array_keys($condition)
	    	));
	    	$this->query_str = ' set ' . $string;
    	}
    }
    protected function find(array $condition=[]){
    	$this->buildWhere($condition);
    	$result = $this->executeRawQuery('select * from ' . $this->table . $this->query_str);
    	return $result->fetch_all(MYSQLI_ASSOC);
    }
    protected function insert(array $columns=[]){
    	$this->buildInsert($columns);
    	$this->executeRawQuery('insert into ' . $this->table . $this->query_str);
    	return mysqli_insert_id($this->connection);
    }
}
