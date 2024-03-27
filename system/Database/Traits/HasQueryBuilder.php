<?php

namespace System\Database\Traits;

use System\Database\DBConnection\DBConnection;

/**
 * The HasQueryBuilder trait provides methods for constructing SQL queries dynamically.
 */
trait HasQueryBuilder
{
    // Holds the SQL query string
    private $sql = '';

    // Holds the WHERE conditions for the query
    protected $where = [];

    // Holds the ORDER BY clauses for the query
    private $orderBy = [];

    // Holds the LIMIT clause for the query
    private $limit = [];

    // Holds the attribute values for binding in the query
    private $values = [];

    // Holds the values to be bound in the query
    private $bindValues = [];

    /**
     * Sets the SQL query string.
     *
     * @param string $query The SQL query string to be set.
     * @return void
     */
    protected function setSql($query)
    {
        $this->sql = $query;
    }

    /**
     * Gets the current SQL query string.
     *
     * @return string The current SQL query string.
     */
    protected function getSql()
    {
        return $this->sql;
    }


    /**
     * The resetSql method resets the SQL query string.
     *
     * @return void
     */
    protected function resetSql()
    {
        $this->sql = '';
    }

    /**
     * The setWhere method sets a WHERE condition in the query.
     *
     * @param string $operator The operator to be used in the WHERE condition.
     * @param string $condition The condition to be applied in the WHERE clause.
     * @return void
     */
    protected function setWhere($operator, $condition)
    {
        // Construct an associative array representing the WHERE condition
        $array = ['operator' => $operator, 'condition' => $condition];
        // Push the WHERE condition into the $where property
        array_push($this->where, $array);
    }

    /**
     * The resetWhere method resets the WHERE conditions in the query.
     *
     * @return void
     */
    protected function resetWhere()
    {
        // Reset the $where property to an empty array
        $this->where = [];
    }

    /**
     * The setOrderBy method sets an ORDER BY clause in the query.
     *
     * @param string $name The name of the attribute to be ordered.
     * @param string $expression The expression for ordering (ASC or DESC).
     * @return void
     */
    protected function setOrderBy($name, $expression)
    {
        // Construct the ORDER BY clause and push it into the $orderBy property
        array_push($this->orderBy, $this->getAttributeName($name) . ' ' . $expression);
    }

    /**
     * The resetOrderBy method resets the ORDER BY clauses in the query.
     *
     * @return void
     */
    protected function resetOrderBy()
    {
        // Reset the $orderBy property to an empty array
        $this->orderBy = [];
    }

    /**
     * The setLimit method sets the LIMIT clause in the SQL query.
     *
     * @param int $from The starting offset of the LIMIT.
     * @param int $number The maximum number of rows to return.
     * @return void
     */
    protected function setLimit($from, $number)
    {
        // Set the starting offset and the number of rows to return in the LIMIT clause
        $this->limit['from'] = (int) $from;
        $this->limit['number'] = (int) $number;
    }

    /**
     * The resetLimit method resets the LIMIT clause in the SQL query.
     *
     * @return void
     */
    protected function resetLimit()
    {
        // Unset the 'from' and 'number' keys in the $limit property
        unset($this->limit['from']);
        unset($this->limit['number']);
    }

    /**
     * The addValue method adds a parameter value for prepared statements.
     *
     * @param string $attribute The attribute name.
     * @param mixed $value The value to be bound.
     * @return void
     */
    protected function addValue($attribute, $value)
    {
        // Set the parameter value in the $values property
        $this->values[$attribute] = $value;
        // Add the parameter value to the array of bound values
        array_push($this->bindValues, $value);
    }

    /**
     * The removeValues method clears the stored parameter values.
     *
     * @return void
     */
    protected function removeValues()
    {
        // Reset the $values and $bindValues properties to empty arrays
        $this->values = [];
        $this->bindValues = [];
    }

    /**
     * The resetQuery method resets all query-related properties.
     *
     * @return void
     */
    protected function resetQuery()
    {
        // Reset all query-related properties
        $this->resetSql();
        $this->resetWhere();
        $this->resetOrderBy();
        $this->resetLimit();
        $this->removeValues();
    }

    /**
     * The executeQuery method executes the constructed SQL query.
     *
     * @return PDOStatement The PDOStatement object representing the result of the query.
     */
    protected function executeQuery()
    {
        // Construct the SQL query string
        $query = $this->sql;

        // Append WHERE conditions to the query string if present
        if (!empty($this->where)) {
            $whereString = '';
            foreach ($this->where as $where) {
                $whereString == '' ?  $whereString .= $where['condition'] : $whereString .= ' ' . $where['operator'] . ' ' . $where['condition'];
            }
            $query .= ' WHERE ' . $whereString;
        }

        // Append ORDER BY clauses to the query string if present
        if (!empty($this->orderBy)) {
            $query .= ' ORDER BY ' . implode(', ', $this->orderBy);
        }

        // Append LIMIT clause to the query string if present
        if (!empty($this->limit)) {
            $query .= ' LIMIT ' . $this->limit['from'] . ', ' . $this->limit['number'];
        }

        // Prepare and execute the SQL query using the PDO instance
        $pdoInstance = DBConnection::getDBConnectionInstance();
        $statement = $pdoInstance->prepare($query);
        if (sizeof($this->bindValues) > sizeof($this->values)) {
            sizeof($this->bindValues) > 0 ? $statement->execute($this->bindValues) : $statement->execute();
        } else {
            sizeof($this->values) > 0 ? $statement->execute(array_values($this->values)) : $statement->execute();
        }

        // Return the PDOStatement object representing the result of the query
        return $statement;
    }



    /**
     * The getCount method retrieves the total number of rows that match the current query conditions.
     *
     * @return int The total number of rows.
     */
    protected function getCount()
    {
        // Initialize an empty query string
        $query = '';

        // Construct the SELECT COUNT(*) query to count the rows
        $query .= "SELECT COUNT(*) FROM " . $this->getTableName();

        // Append WHERE conditions to the query string if present
        if (!empty($this->where)) {
            $whereString = '';
            foreach ($this->where as $where) {
                $whereString == '' ?  $whereString .= $where['condition'] : $whereString .= ' ' . $where['operator'] . ' ' . $where['condition'];
            }
            $query .= ' WHERE ' . $whereString;
        }

        // Append semicolon to the query string
        $query .= ' ;';

        // Retrieve the PDO instance
        $pdoInstance = DBConnection::getDBConnectionInstance();

        // Prepare and execute the SQL query using the PDO instance
        $statement = $pdoInstance->prepare($query);
        if (sizeof($this->bindValues) > sizeof($this->values)) {
            sizeof($this->bindValues) > 0 ? $statement->execute($this->bindValues) : $statement->execute();
        } else {
            sizeof($this->values) > 0 ? $statement->execute(array_values($this->values)) : $statement->execute();
        }

        // Fetch and return the total number of rows as a single column
        return $statement->fetchColumn();
    }

    /**
     * The getTableName method returns the formatted table name for use in SQL queries.
     *
     * @return string The formatted table name.
     */
    protected function getTableName()
    {
        // Format and return the table name with backticks for SQL queries
        return ' `' . $this->table . '`';
    }

    /**
     * The getAttributeName method returns the formatted attribute name for use in SQL queries.
     *
     * @param string $attribute The attribute name.
     * @return string The formatted attribute name.
     */
    protected function getAttributeName($attribute)
    {
        // Format and return the attribute name with table name and backticks for SQL queries
        return ' `' . $this->table . '`.`' . $attribute . '` ';
    }
}
