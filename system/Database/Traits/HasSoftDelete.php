<?php

namespace System\Database\Traits;

trait HasSoftDelete
{
    /**
     * Method to soft delete a record by setting the deletion timestamp.
     * 
     * @param int|null $id The ID of the record to be soft deleted.
     * @return bool Whether the soft deletion operation was successful or not.
     */
    protected function deleteMethod($id = null)
    {
        $object = $this;
        if ($id) {
            $this->resetQuery(); // Resetting the query builder.
            $object = $this->findMethod($id); // Finding the object by ID.
        }
        if ($object) {
            $object->resetQuery(); // Resetting the query builder for the object.
            $object->setSql("UPDATE " . $object->getTableName() . " SET " . $this->getAttributeName($this->deletedAt) . " = NOW() "); // Setting SQL to update the deletion timestamp.
            $object->setWhere("AND", $this->getAttributeName($object->primaryKey) . " = ?"); // Adding WHERE condition for the primary key.
            $object->addValue($object->primaryKey, $object->{$object->primaryKey}); // Binding the primary key value.
            return $object->executeQuery(); // Executing the update query.
        }
    }

    /**
     * Method to fetch all records that are not soft deleted.
     * 
     * @return array Array of objects representing the fetched records.
     */
    protected function allMethod()
    {
        $this->setSql("SELECT " . $this->getTableName() . ".* FROM " . $this->getTableName()); // Setting SQL for fetching all records.
        $this->setWhere("AND", $this->getAttributeName($this->deletedAt) . " IS NULL "); // Adding WHERE condition to exclude soft deleted records.
        $statement = $this->executeQuery(); // Executing the query.
        $data = $statement->fetchAll(); // Fetching data from the statement.
        if ($data) {
            $this->arrayToObjects($data); // Converting fetched data to objects.
            return $this->collection; // Returning the collection of objects.
        }
        return []; // Returning an empty array if no records found.
    }

    /**
     * Method to find a record by ID that is not soft deleted.
     * 
     * @param int $id The ID of the record to find.
     * @return object|null The found object or null if not found or soft deleted.
     */
    protected function findMethod($id)
    {
        $this->resetQuery(); // Resetting the query builder.
        $this->setSql("SELECT " . $this->getTableName() . ".* FROM " . $this->getTableName()); // Setting SQL for fetching the record.
        $this->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ? "); // Adding WHERE condition for the primary key.
        $this->addValue($this->primaryKey, $id); // Binding the primary key value.
        $this->setWhere("AND", $this->getAttributeName($this->deletedAt) . " IS NULL "); // Adding WHERE condition to exclude soft deleted records.
        $statement = $this->executeQuery(); // Executing the query.
        $data = $statement->fetch(); // Fetching data from the statement.
        $this->setAllowedMethods(['update', 'delete', 'save']); // Setting allowed methods for the object.
        if ($data)
            return $this->arrayToAttributes($data); // Converting fetched data to object attributes.
        return null; // Returning null if record not found or soft deleted.
    }

    /**
     * Method to get records based on provided conditions that are not soft deleted.
     * 
     * @param array $array Array of field names to fetch.
     * @return array Array of objects representing the fetched records.
     */
    protected function getMethod($array = [])
    {
        if ($this->sql == '') {
            if (empty($array)) {
                $fields = $this->getTableName() . '.*'; // If no specific fields are provided, fetch all fields.
            } else {
                foreach ($array as $key => $field) {
                    $array[$key] = $this->getAttributeName($field); // Converting field names to their attribute names.
                }
                $fields = implode(' , ', $array); // Joining field names with commas.
            }
            $this->setSql("SELECT $fields FROM " . $this->getTableName()); // Setting SQL for fetching records.
        }
        $this->setWhere("AND", $this->getAttributeName($this->deletedAt) . " IS NULL "); // Adding WHERE condition to exclude soft deleted records.
        $statement = $this->executeQuery(); // Executing the query.
        $data = $statement->fetchAll(); // Fetching data from the statement.
        if ($data) {
            $this->arrayToObjects($data); // Converting fetched data to objects.
            return $this->collection; // Returning the collection of objects.
        }
        return []; // Returning an empty array if no records found.
    }

    /**
     * Method to paginate records that are not soft deleted.
     * 
     * @param int $perPage Number of records per page.
     * @return array Array of objects representing the fetched records for the current page.
     */
    protected function paginateMethod($perPage)
    {
        $this->setWhere("AND", $this->getAttributeName($this->deletedAt) . " IS NULL "); // Adding WHERE condition to exclude soft deleted records.
        $totalRows = $this->getCount(); // Getting the total count of records.
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Getting the current page number from the query parameters.
        $totalPages = ceil($totalRows / $perPage); // Calculating the total number of pages.
        $currentPage = min($currentPage, $totalPages); // Making sure current page is not greater than total pages.
        $currentPage = max($currentPage, 1); // Making sure current page is not less than 1.
        $currentRow = ($currentPage - 1) * $perPage; // Calculating the starting row for the current page.
        $this->setLimit($currentRow, $perPage); // Setting limit for pagination.
        if ($this->sql == '') {
            $this->setSql("SELECT " . $this->getTableName() . ".* FROM " . $this->getTableName()); // Setting SQL for fetching records.
        }
        $statement = $this->executeQuery(); // Executing the query.
        $data = $statement->fetchAll(); // Fetching data from the statement.
        if ($data) {
            $this->arrayToObjects($data); // Converting fetched data to objects.
            return $this->collection; // Returning the collection of objects.
        }
        return []; // Returning an empty array if no records found.
    }
}
