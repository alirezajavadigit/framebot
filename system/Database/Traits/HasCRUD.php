<?php

namespace System\Database\Traits;

use System\Database\DBConnection\DBConnection;

/**
 * The trait for CRUD (Create, Read, Update, Delete) operations.
 *
 * This trait provides methods for creating, updating, deleting, and retrieving records from the database.
 */
trait HasCRUD
{
    /**
     * Creates a new record in the database.
     *
     * @param array $values An associative array of column names and their corresponding values.
     * @return mixed The result of the save method.
     */
    protected function createMethod($values)
    {
        // Encode values if necessary and set attributes
        $values = $this->arrayToCastEncodeValue($values);
        $this->arrayToAttributes($values, $this);
        // Save the record
        return $this->saveMethod();
    }

    /**
     * Updates an existing record in the database.
     *
     * @param array $values An associative array of column names and their corresponding values.
     * @return mixed The result of the save method.
     */
    protected function updateMethod($values)
    {
        // Encode values if necessary and set attributes
        $values = $this->arrayToCastEncodeValue($values);
        $this->arrayToAttributes($values, $this);
        // Save the updated record
        return $this->saveMethod();
    }

    /**
     * Deletes a record from the database.
     *
     * @param mixed $id The primary key value of the record to delete.
     * @return mixed The result of the executeQuery method.
     */
    protected function deleteMethod($id = null)
    {
        // Initialize the object and reset query parameters
        $object = $this;
        $this->resetQuery();
        // If ID is provided, find the record by ID
        if ($id) {
            $object = $this->findMethod($id);
            $this->resetQuery();
        }
        // Construct DELETE query and execute
        $object->setSql("DELETE FROM " . $object->getTableName());
        $object->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ? ");
        $object->addValue($object->primaryKey, $object->{$object->primaryKey});
        return $object->executeQuery();
    }

    /**
     * Retrieves all records from the database.
     *
     * @return array The collection of retrieved records.
     */
    protected function allMethod()
    {
        // Construct SELECT query to fetch all records
        $this->setSql("SELECT * FROM " . $this->getTableName());
        // Execute query and fetch data
        $statement = $this->executeQuery();
        $data = $statement->fetchAll();
        // If data exists, convert to objects and return collection
        if ($data) {
            $this->arrayToObjects($data);
            return $this->collection;
        }
        // Return an empty array if no records found
        return [];
    }

    /**
     * Finds a record in the database by its primary key.
     *
     * @param mixed $id The value of the primary key.
     * @return mixed|null The found record as an object, or null if not found.
     */
    protected function findMethod($id)
    {
        // Construct SELECT query to find record by ID
        $this->setSql("SELECT * FROM " . $this->getTableName());
        $this->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ? ");
        $this->addValue($this->primaryKey, $id);
        // Execute query and fetch data
        $statement = $this->executeQuery();
        $data = $statement->fetch();
        // Allow subsequent operations on the found record
        $this->setAllowedMethods(['update', 'delete', 'save']);
        // If data exists, convert to object and return
        if ($data) {
            return $this->arrayToAttributes($data);
        }
        // Return null if record not found
        return null;
    }

    /**
     * Adds a WHERE condition to the query with an AND operator.
     *
     * @param string $attribute The attribute name.
     * @param mixed $firstValue The value to compare against.
     * @param mixed|null $secondValue Optional. Additional value for comparison.
     * @return $this
     */
    protected function whereMethod($attribute, $firstValue, $secondValue = null)
    {
        // Determine the condition based on the number of values provided
        if ($secondValue === null) {
            $condition = $this->getAttributeName($attribute) . ' = ?';
            $this->addValue($attribute, $firstValue);
        } else {
            $condition = $this->getAttributeName($attribute) . ' ' . $firstValue . ' ?';
            $this->addValue($attribute, $secondValue);
        }
        // Set WHERE condition with AND operator
        $operator = 'AND';
        $this->setWhere($operator, $condition);
        // Allow chaining of other methods
        $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);
        return $this;
    }

    /**
     * Adds a WHERE condition to the query with an OR operator.
     *
     * @param string $attribute The attribute name.
     * @param mixed $firstValue The value to compare against.
     * @param mixed|null $secondValue Optional. Additional value for comparison.
     * @return $this
     */
    protected function whereOrMethod($attribute, $firstValue, $secondValue = null)
    {
        // Determine the condition based on the number of values provided
        if ($secondValue === null) {
            $condition = $this->getAttributeName($attribute) . ' = ?';
            $this->addValue($attribute, $firstValue);
        } else {
            $condition = $this->getAttributeName($attribute) . ' ' . $firstValue . ' ?';
            $this->addValue($attribute, $secondValue);
        }
        // Set WHERE condition with OR operator
        $operator = 'OR';
        $this->setWhere($operator, $condition);
        // Allow chaining of other methods
        $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);
        return $this;
    }


    /**
     * Sets a WHERE condition in the query to filter rows where the specified attribute's value is NULL.
     *
     * @param string $attribute The name of the attribute to check for NULL values.
     * @return $this Returns the instance for method chaining.
     */
    protected function whereNullMethod($attribute)
    {
        // Define the condition for NULL values of the attribute
        $condition = $this->getAttributeName($attribute) . ' IS NULL ';

        // Set the logical operator for the WHERE clause
        $operator = 'AND';

        // Add the WHERE condition to the query
        $this->setWhere($operator, $condition);

        // Set the allowed methods for method chaining
        $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);

        // Return the instance for method chaining
        return $this;
    }

    /**
     * Sets a WHERE condition in the query to filter rows where the specified attribute's value is NOT NULL.
     *
     * @param string $attribute The name of the attribute to check for non-NULL values.
     * @return $this Returns the instance for method chaining.
     */
    protected function whereNotNullMethod($attribute)
    {
        // Define the condition for non-NULL values of the attribute
        $condition = $this->getAttributeName($attribute) . ' IS NOT NULL ';

        // Set the logical operator for the WHERE clause
        $operator = 'AND';

        // Add the WHERE condition to the query
        $this->setWhere($operator, $condition);

        // Set the allowed methods for method chaining
        $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);

        // Return the instance for method chaining
        return $this;
    }

    /**
     * Sets a WHERE condition in the query to filter rows where the specified attribute's value is in a given array.
     *
     * @param string $attribute The name of the attribute to filter.
     * @param array $values The array of values to filter by.
     * @return $this Returns the instance for method chaining.
     */
    protected function whereInMethod($attribute, $values)
    {
        // Check if the provided values are in array format
        if (is_array($values)) {
            $valuesArray = [];

            // Iterate over each value and add it as a parameter
            foreach ($values as $value) {
                $this->addValue($attribute, $value);
                array_push($valuesArray, '?');
            }

            // Construct the condition for the WHERE IN clause
            $condition =  $this->getAttributeName($attribute) . ' IN (' . implode(' , ', $valuesArray) . ')';

            // Set the logical operator for the WHERE clause
            $operator = 'AND';

            // Add the WHERE condition to the query
            $this->setWhere($operator, $condition);

            // Set the allowed methods for method chaining
            $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);

            // Return the instance for method chaining
            return $this;
        }
    }


    /**
     * Sets the ORDER BY clause in the query to sort the results by the specified attribute and expression.
     *
     * @param string $attribute The attribute by which to sort the results.
     * @param string $expression The expression to determine the sorting order (ASC or DESC).
     * @return $this Returns the instance for method chaining.
     */
    protected function orderByMethod($attribute, $expression)
    {
        // Set the ORDER BY clause with the provided attribute and expression
        $this->setOrderBy($attribute, $expression);

        // Set the allowed methods for method chaining
        $this->setAllowedMethods(['limit', 'orderBy', 'get', 'paginate']);

        // Return the instance for method chaining
        return $this;
    }

    /**
     * Sets the LIMIT clause in the query to restrict the number of returned rows.
     *
     * @param int $from The starting index from which to limit the rows.
     * @param int $number The maximum number of rows to return.
     * @return $this Returns the instance for method chaining.
     */
    protected function limitMethod($from, $number)
    {
        // Set the LIMIT clause with the provided starting index and number of rows
        $this->setLimit($from, $number);

        // Set the allowed methods for method chaining
        $this->setAllowedMethods(['limit', 'get', 'paginate']);

        // Return the instance for method chaining
        return $this;
    }

    /**
     * Executes the SELECT query with optional specified fields and returns the resulting data.
     *
     * @param array $array An array of field names to include in the SELECT statement.
     * @return array Returns an array containing the retrieved data.
     */
    protected function getMethod($array = [])
    {
        // Check if the SQL query is not already set
        if ($this->sql == '') {
            // If no specific fields are provided, retrieve all fields
            if (empty($array)) {
                $fields = $this->getTableName() . '.*';
            } else {
                // Otherwise, convert field names to their corresponding attribute names
                foreach ($array as $key => $field) {
                    $array[$key] = $this->getAttributeName($field);
                }
                $fields = implode(' , ', $array);
            }
            // Construct the SELECT query with the specified fields
            $this->setSql("SELECT $fields FROM " . $this->getTableName());
        }

        // Execute the query and fetch the resulting data
        $statement = $this->executeQuery();
        $data = $statement->fetchAll();

        // If data is retrieved, convert it to objects and return as a collection
        if ($data) {
            $this->arrayToObjects($data);
            return $this->collection;
        }

        // Return an empty array if no data is retrieved
        return [];
    }



    /**
     * Paginates the results of the query based on the specified number of items per page.
     *
     * @param int $perPage The number of items to display per page.
     * @return array Returns an array containing the paginated data.
     */
    protected function paginateMethod($perPage)
    {
        // Calculate the total number of rows
        $totalRows = $this->getCount();

        // Determine the current page number
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Calculate the total number of pages
        $totalPages = ceil($totalRows / $perPage);

        // Ensure the current page is within the valid range
        $currentPage = min($currentPage, $totalPages);
        $currentPage = max($currentPage, 1);

        // Calculate the starting row for the current page
        $currentRow = ($currentPage - 1) * $perPage;

        // Set the LIMIT clause to fetch the data for the current page
        $this->setLimit($currentRow, $perPage);

        // If SQL query is not already set, construct the SELECT query
        if ($this->sql == '') {
            $this->setSql("SELECT " . $this->getTableName() . ".* FROM " . $this->getTableName());
        }

        // Execute the query and fetch the resulting data
        $statement = $this->executeQuery();
        $data = $statement->fetchAll();

        // If data is retrieved, convert it to objects and return as a collection
        if ($data) {
            $this->arrayToObjects($data);
            return $this->collection;
        }

        // Return an empty array if no data is retrieved
        return [];
    }

    /**
     * Saves the current object to the database, either by inserting a new record or updating an existing one.
     *
     * @return $this Returns the instance for method chaining.
     */
    protected function saveMethod()
    {
        // Generate the fill string for INSERT or UPDATE query
        $fillString = $this->fill();

        // Check if the primary key is set to determine if it's an INSERT or UPDATE operation
        if (!isset($this->{$this->primaryKey})) {
            // Construct the INSERT query with the fill string and current timestamp for 'createdAt' attribute
            $this->setSql("INSERT INTO " . $this->getTableName() . " SET $fillString, " . $this->getAttributeName($this->createdAt) . "=Now()");
        } else {
            // Construct the UPDATE query with the fill string and current timestamp for 'updatedAt' attribute
            $this->setSql("UPDATE " . $this->getTableName() . " SET $fillString, " . $this->getAttributeName($this->updatedAt) . "=Now()");

            // Set the WHERE clause for the primary key
            $this->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ?");
            $this->addValue($this->primaryKey, $this->{$this->primaryKey});
        }

        // Execute the query
        $this->executeQuery();

        // Reset the query builder
        $this->resetQuery();

        // If it's an INSERT operation, fetch the inserted object from the database
        if (!isset($this->{$this->primaryKey})) {
            $object = $this->findMethod(DBConnection::newInsertId());
            $defaultVars = get_class_vars(get_called_class());
            $allVars = get_object_vars($object);
            $differentVars = array_diff(array_keys($allVars), array_keys($defaultVars));
            foreach ($differentVars as $attribute) {
                // Register attributes with their values in the current object
                $this->inCastsAttributes($attribute) == true ? $this->registerAttribute($this, $attribute, $this->castEncodeValue($attribute, $object->$attribute)) : $this->registerAttribute($this, $attribute, $object->$attribute);
            }
        }

        // Reset the query builder
        $this->resetQuery();

        // Set the allowed methods for method chaining
        $this->setAllowedMethods(['update', 'delete', 'find']);

        // Return the instance for method chaining
        return $this;
    }

    /**
     * Generates the fill string for INSERT or UPDATE query based on the fillable attributes.
     *
     * @return string Returns the fill string for the query.
     */
    protected function fill()
    {
        // Initialize an empty array to store fill attributes and values
        $fillArray = array();

        // Iterate through fillable attributes and add them to the fill array
        foreach ($this->fillable as $attribute) {
            if (isset($this->$attribute)) {
                // Add attribute and placeholder to the fill array
                array_push($fillArray, $this->getAttributeName($attribute) . " = ?");

                // Determine whether to cast the attribute value before adding to the query
                $this->inCastsAttributes($attribute) == true ? $this->addValue($attribute, $this->castEncodeValue($attribute, $this->$attribute)) : $this->addValue($attribute, $this->$attribute);
            }
        }

        // Generate the fill string by imploding the fill array with commas
        $fillString = implode(', ', $fillArray);

        // Return the fill string
        return $fillString;
    }
}
