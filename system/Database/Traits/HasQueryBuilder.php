<?php

namespace System\Database\Traits;

use System\Database\DBConnection\DBConnection;

trait HasQueryBuilder
{

    private $sql = '';
    protected $where = [];
    private $orderBy = [];
    private $limit = [];
    private $values = [];
    private $bindValues = [];

    protected function setSql($query)
    {
        $this->sql = $query;
    }
    protected function getSql()
    {
        return $this->sql;
    }
    protected function resetSql()
    {
        $this->sql = '';
    }

    protected function setWhere($operator, $condition)
    {

        $array = ['operator' => $operator, 'condition' => $condition];
        array_push($this->where, $array);
    }

    protected function resetWhere()
    {
        $this->where = [];
    }

    protected function setOrderBy($name, $expression)
    {

        array_push($this->orderBy, $this->getAttributeName($name) . ' ' . $expression);
    }

    protected function resetOrderBy()
    {
        $this->orderBy = [];
    }

    protected function setLimit($from, $number)
    {

        $this->limit['from'] = (int) $from;
        $this->limit['number'] = (int) $number;
    }

    protected function resetLimit()
    {
        unset($this->limit['from']);
        unset($this->limit['number']);
    }


    protected function addValue($attribute, $value)
    {

        $this->values[$attribute] = $value;
        array_push($this->bindValues, $value);
    }

    protected function removeValues()
    {
        $this->values = [];
        $this->bindValues = [];
    }


    protected function resetQuery()
    {

        $this->resetSql();
        $this->resetWhere();
        $this->resetOrderBy();
        $this->resetLimit();
        $this->removeValues();
    }

    protected function executeQuery()
    {

        $query = '';
        $query .= $this->sql;

        if (!empty($this->where)) {

            $whereString = '';
            foreach ($this->where as $where) {
                $whereString == '' ?  $whereString .= $where['condition'] : $whereString .= ' ' . $where['operator'] . ' ' . $where['condition'];
            }
            $query .= ' WHERE ' . $whereString;
        }

        if (!empty($this->orderBy)) {
            $query .= ' ORDER BY ' . implode(', ', $this->orderBy);
        }
        if (!empty($this->limit)) {
            $query .= ' limit ' . $this->limit['from'] . ' , ' . $this->limit['number'] . ' ';
        }
        $query .= ' ;';
        $pdoInstance = DBConnection::getDBConnectionInstance();
        $statement = $pdoInstance->prepare($query);
        if (sizeof($this->bindValues) > sizeof($this->values)) {
            sizeof($this->bindValues) > 0 ? $statement->execute($this->bindValues) : $statement->execute();
        } else {
            sizeof($this->values) > 0 ? $statement->execute(array_values($this->values)) : $statement->execute();
        }
        return $statement;
    }


    protected function getCount()
    {

        $query = '';
        $query .= "SELECT COUNT(*) FROM " . $this->getTableName();

        if (!empty($this->where)) {

            $whereString = '';
            foreach ($this->where as $where) {
                $whereString == '' ?  $whereString .= $where['condition'] : $whereString .= ' ' . $where['operator'] . ' ' . $where['condition'];
            }
            $query .= ' WHERE ' . $whereString;
        }
        $query .= ' ;';

        $pdoInstance = DBConnection::getDBConnectionInstance();
        $statement = $pdoInstance->prepare($query);
        if (sizeof($this->bindValues) > sizeof($this->values)) {
            sizeof($this->bindValues) > 0 ? $statement->execute($this->bindValues) : $statement->execute();
        } else {
            sizeof($this->values) > 0 ? $statement->execute(array_values($this->values)) : $statement->execute();
        }
        return $statement->fetchColumn();
    }

    protected function getTableName()
    {

        return ' `' . $this->table . '`';
    }

    protected function getAttributeName($attribute)
    {

        return ' `' . $this->table . '`.`' . $attribute . '` ';
    }
}
