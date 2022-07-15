<?php

namespace PHPMVC\Models;

use PDOException;
use PHPMVC\Lib\Database\DatabaseHandler;

class AbstractModel
{
    const DATA_TYPE_BOOL    = \PDO::PARAM_BOOL;
    const DATA_TYPE_STR     = \PDO::PARAM_STR;
    const DATA_TYPE_INT     = \PDO::PARAM_INT;
    const DATA_TYPE_DECIMAL = 4;
    const DATA_TYPE_DATE    = 5;

    // valid date range is 1000-01-01 to 9999-12-31
    const VALIDATE_DATE_STRING = '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/';

    const VALIDATE_DATE_NUMERIC = '^\d{6,8}$';
    const DEFAULT_MYSQL_DATE = '1970-01-01';

    protected static $tableName;
    protected static $tableSchema = [];
    protected static $primaryKey;

    private function prepareValues(\PDOStatement &$stmt): void
    {
        foreach(static::$tableSchema as $columnName => $type)
        {
            if($type == 4){
                $sanitizedValue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(":{$columnName}",$sanitizedValue);
            } elseif($type == 5){
                if(preg_match(self::VALIDATE_DATE_STRING, $this->$columnName) || $this->$columnName == null){
                    $stmt->bindValue(":{$columnName}", $this->$columnName);
                }
            } else {
                $stmt->bindValue(":{$columnName}", $this->$columnName, $type);
            }
        }
    }

    private static function buildNameParametersSQL(): string
    {
        $namedParams = '';
        foreach(static::$tableSchema as $columnName => $type)
        {
            $namedParams .= $columnName . ' = :' . $columnName . ', ';
        }
        return trim($namedParams, ', ');
    }

    public function create(): bool
    {
        $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . self::buildNameParametersSQL();
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->prepareValues($stmt);
        try{
            if($stmt->execute()){
                $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
                return true;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update(): bool
    {
        $sql = 'UPDATE ' . static::$tableName . ' SET ' . self::buildNameParametersSQL() . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->prepareValues($stmt);
        try{
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function save($rimaryKeyCheck = true): bool
    {
        if(false === $rimaryKeyCheck){
            return $this->create();
        }
        return $this->{static::$primaryKey} === null ? $this->create() : $this->update();
    }

    public function delete(): bool
    {
        $sql = 'DELETE FROM ' . static::$tableName . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
        $stmt = DatabaseHandler::factory()->prepare($sql);
        return $stmt->execute();
    }

    public static function getAll(): array|false
    {
        $sql = 'SELECT * FROM ' . static::$tableName;
        $stmt = DatabaseHandler::factory()->prepare($sql);

        if($stmt->execute() === true){
            if(method_exists(get_called_class(), '__construct')){
                $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $result = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            }
            return  (is_array($result) && !empty($result))? $result : false ;
        } else {
            return false;
        }
        
    }

    public static function getByKey($pk): mixed
    {
        $sql = 'SELECT * FROM ' . static::$tableName . ' WHERE '. static::$primaryKey  . ' = "' . $pk . '"';
        $stmt = DatabaseHandler::factory()->prepare($sql);

        if($stmt->execute() === true)
        {
            if(method_exists(get_called_class(), '__construct')){
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            }
            return !empty($obj) ? array_shift($obj) : false;
        } else {
            return false;
        }
    }

    public static function getBy($columns, $options = array()): array|false
    {
        $whereClausecolumns = array_keys($columns);
        $whereClauseValues = array_values($columns);
        $whereClause = [];

        for($i = 0, $ii = count($whereClausecolumns); $i < $ii; $i++){
            $whereClause[$i] = $whereClausecolumns[$i] . ' = "' . $whereClauseValues[$i] . '"'; 
        }

        $whereClause = implode(' AND ', $whereClause);

        $sql = 'SELECT * FROM ' . static::$tableName . ' WHERE ' . $whereClause;
        return static::get($sql, $options);
    }

    public static function get($sql, $options = array()): array|false
    {
        $stmt = DatabaseHandler::factory()->prepare($sql);

        if(!empty($options)){
            foreach($options as $columnName => $type)
            {
                if($type == 4){
                    $sanitizedValue = filter_var($type[0], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindValue(":{$columnName}",$sanitizedValue);
                } else {
                    $stmt->bindValue(":{$columnName}", $type[1], $type[0]);
                }
            }
        }

        if($stmt->execute() === true){
            if(method_exists(get_called_class(), '__construct')){
                $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $result = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            }
            return (is_array($result) && !empty($result))? $result : false;
        } else {
            return false;
        }
    }

    public static function getOne($sql, $options = array()): mixed
    {
        $result = static::get($sql, $options);
        return is_array($result) && !empty($result) ? array_shift($result) : false;
    }

    public static function getModelTableName()
    {
        return static::$tableName;
    }
}