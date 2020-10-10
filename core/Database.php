<?php

namespace Core;

class Database
{
    private static $instance;
	private $connection;
    private $tableName;
    private $fieldsName = '*';
    private $query;

	private function __construct()
	{
	    echo 'an object creates';
		// Connect To Mysql
		$this->connection = new \mysqli('localhost','root','','oop');
		// Check Valid Connection and Show error and error Number
		if ($this->connection->connect_error) {
			die('Falid Connection : '.$this->connection->connect_error.' Errno = ( '.$this->connection->connect_errno.' )');
		}
	} // end construct

    private function __clone()
    {
        
    } // end clone

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
            return self::$instance;
    } // end getInstance

	public function table(string $tableName): Database
    {
        $this->tableName = (string) $tableName;
        $this->query = '';
        return $this;
    } // end table

    public function select(string $fields = '*'): Database
    {
        $this->fieldsName = $fields;
        $this->query = "SELECT `{$this->fieldsName}` FROM `{$this->tableName}` ";
        return $this;
    } // end select

    public function where(string $field, string $operator, $value): Database
    {
        $this->query .= " WHERE `{$field}` {$operator} '{$value}' ";
        return $this;
    } // end where

    public function andWhere(string $field, string $operator, $value)
    {
        $this->query .= "AND `{$field}` {$operator} '{$value}' ";
        return $this;
    } // end andWhere

    public function orWhere(string $field, string $operator, $value)
    {
        $this->query .= "OR `{$field}` {$operator} '{$value}' ";
        return $this;
    } // end orWhere

    public function limit(int $number = 1): Database
    {
        $this->query .= "LIMIT {$number} ";
        return $this;
    } // end limit

    public function orderBy(string $field, string $sort = 'ASC'): Database
    {
        $this->query .= "ORDER BY `{$field}` {$sort} ";
        return $this;
    } // end orderBy

    public function get()
    {
        if (! empty($this->query)) {
            $result = $this->connection->query($this->query);
            if ($result) {
                if ($result->num_rows > 0)
                    return $result->fetch_all(MYSQLI_ASSOC);
                else
                    return [];
            }
        }
        $this->query = "SELECT {$this->fieldsName} FROM `{$this->tableName}`";
        $result = $this->connection->query($this->query);
        if ($result) {
            if ($result->num_rows > 0)
                return $result->fetch_all(MYSQLI_ASSOC);
            else
                return [];
        }
    } // end get

    public function getOne()
    {
         $this->limit();
        $result = $this->connection->query($this->query);
        if ($result) {
            if ($result->num_rows > 0)
                return $result->fetch_assoc();
            else
                return [];
        }
    } // end getOne

    /*public function insert(array $data): bool
    {
        $columns = '';
        $values = '';
        foreach ($data as $key => $value) {
            $columns .= "`$key`,";
            $values .= "'$value',";
        }
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');
        $this->query = "INSERT INTO `{$this->tableName}` ($columns) VALUES ($values) ";
        return $this->execute();
    } // end insert
    */

    public function insert(array $data): Database
    {
        $columns = '';
        $values = '';
        foreach ($data as $key => $value) {
            $columns .= "`$key`,";
            $values  .= $this->connection->real_escape_string($value);
            $values .= "'$value',";
        }
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');
        $this->query = "INSERT INTO `{$this->tableName}` ($columns) VALUES ($values) ";
        return $this;
    } // end insert

    public function update(array $data): Database
    {
        $queryParts = '';
        foreach ($data as $key => $value){
            $value = $this->connection->real_escape_string($value);
            $queryParts .= "`".$key."` = '$value' ,";
        }
        $queryParts = rtrim($queryParts, ',');
        $this->query = "UPDATE `{$this->tableName}` SET  $queryParts ";
        return $this;
    } // end update

    public function delete(): Database
    {
        $this->query = "DELETE FROM `{$this->tableName}` ";
        return $this;
    } // end delete

    public function save()
    {
        $result = $this->connection->query($this->query);
        return ! empty($result);
    } // end save

    public function showTable()
    {
        echo $this->tableName;
    }
    public function showQuery()
    {
        echo $this->query;
    }
}
?>