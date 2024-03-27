<?php

namespace System\Database\Traits;

trait HasRelation
{
    /**
     * The hasOne method establishes a one-to-one relationship with another model.
     *
     * @param string $model The name of the related model class.
     * @param string $foreignKey The foreign key in the related model's table.
     * @param string $localKey The local key in the current model's table.
     * @return mixed|null The related model object if found, otherwise null.
     */
    protected function hasOne($model, $foreignKey, $localKey)
    {
        // Check if the current model has a primary key value
        if ($this->{$this->primaryKey}) {
            // Create an instance of the related model
            $modelObject = new $model();
            // Retrieve and return the one-to-one relationship
            return $modelObject->getHasOneRelation($this->table, $foreignKey, $localKey, $this->$localKey);
        }
    }

    /**
     * The getHasOneRelation method retrieves the related model in a one-to-one relationship.
     *
     * @param string $table The name of the related model's table.
     * @param string $foreignKey The foreign key in the related model's table.
     * @param string $otherKey The key in the related model's table.
     * @param mixed $otherKeyValue The value of the key in the related model.
     * @return mixed|null The related model object if found, otherwise null.
     */
    public function getHasOneRelation($table, $foreignKey, $otherKey, $otherKeyValue)
    {
        // Construct the SQL query for retrieving the related model in a one-to-one relationship
        $this->setSql("SELECT `b`.* FROM `{$table}` AS `a` JOIN " . $this->getTableName() . " AS `b` on `a`.`{$otherKey}` = `b`.`{$foreignKey}` ");
        $this->setWhere('AND', "`a`.`$otherKey` = ? ");
        $this->table = 'b';
        $this->addValue($otherKey, $otherKeyValue);
        // Execute the query and fetch the data
        $statement = $this->executeQuery();
        $data = $statement->fetch();
        // If data is found, convert it to model attributes and return, otherwise return null
        if ($data)
            return $this->arrayToAttributes($data);
        return null;
    }

    /**
     * The hasMany method establishes a one-to-many relationship with another model.
     *
     * @param string $model The name of the related model class.
     * @param string $foreignKey The foreign key in the related model's table.
     * @param string $otherKey The key in the related model's table.
     * @return mixed|null The related model object if found, otherwise null.
     */
    protected function hasMany($model, $foreignKey, $otherKey)
    {
        // Check if the current model has a primary key value
        if ($this->{$this->primaryKey}) {
            // Create an instance of the related model
            $modelObject = new $model;
            // Retrieve and return the one-to-many relationship
            return $modelObject->getHasManyRelation($this->table, $foreignKey, $otherKey, $this->$otherKey);
        }
    }

    /**
     * The getHasManyRelation method retrieves the related models in a one-to-many relationship.
     *
     * @param string $table The name of the related model's table.
     * @param string $foreignKey The foreign key in the related model's table.
     * @param string $otherKey The key in the related model's table.
     * @param mixed $otherKeyValue The value of the key in the related model.
     * @return mixed|null The related model object if found, otherwise null.
     */
    public function getHasManyRelation($table, $foreignKey, $otherKey, $otherKeyValue)
    {
        // Construct the SQL query for retrieving the related models in a one-to-many relationship
        $this->setSql("SELECT `b`.* FROM `{$table}` AS `a` JOIN " . $this->getTableName() . " AS `b` on `a`.`{$otherKey}` = `b`.`{$foreignKey}` ");
        $this->setWhere('AND', "`a`.`$otherKey` = ? ");
        $this->table = 'b';
        $this->addValue($otherKey, $otherKeyValue);
        // Return the current instance to allow chaining of methods
        return $this;
    }


    /**
     * The belongsTo method establishes a many-to-one relationship with another model.
     *
     * @param string $model The name of the related model class.
     * @param string $foreignKey The foreign key in the current model's table.
     * @param string $localKey The local key in the related model's table.
     * @return mixed|null The related model object if found, otherwise null.
     */
    protected function belongsTo($model, $foreignKey, $localKey)
    {
        // Check if the current model has a primary key value
        if ($this->{$this->primaryKey}) {
            // Create an instance of the related model
            $modelObject = new $model();
            // Retrieve and return the many-to-one relationship
            return $modelObject->getBelongsToRelation($this->table, $foreignKey, $localKey, $this->$foreignKey);
        }
    }

    /**
     * The getBelongsToRelation method retrieves the related model in a many-to-one relationship.
     *
     * @param string $table The name of the related model's table.
     * @param string $foreignKey The foreign key in the current model's table.
     * @param string $otherKey The key in the related model's table.
     * @param mixed $foreignKeyValue The value of the foreign key in the current model.
     * @return mixed|null The related model object if found, otherwise null.
     */
    public function getBelongsToRelation($table, $foreignKey, $otherKey, $foreignKeyValue)
    {
        // Construct the SQL query for retrieving the related model in a many-to-one relationship
        $this->setSql("SELECT `b`.* FROM `{$table}` AS `a` JOIN " . $this->getTableName() . " AS `b` on `a`.`{$foreignKey}` = `b`.`{$otherKey}` ");
        $this->setWhere('AND', "`a`.`$foreignKey` = ? ");
        $this->table = 'b';
        $this->addValue($foreignKey, $foreignKeyValue);
        // Execute the query and fetch the data
        $statement = $this->executeQuery();
        $data = $statement->fetch();
        // If data is found, convert it to model attributes and return, otherwise return null
        if ($data)
            return $this->arrayToAttributes($data);
        return null;
    }

    /**
     * The belongsToMany method establishes a many-to-many relationship with another model through an intermediate table.
     *
     * @param string $model The name of the related model class.
     * @param string $commonTable The name of the intermediate table.
     * @param string $localKey The local key in the current model's table.
     * @param string $middleForeignKey The foreign key in the intermediate table pointing to the current model.
     * @param string $middleRelation The key in the intermediate table.
     * @param string $foreignKey The foreign key in the related model's table.
     * @return mixed|null The related model object if found, otherwise null.
     */
    protected function belongsToMany($model, $commonTable, $localKey, $middleForeignKey, $middleRelation, $foreignKey)
    {
        // Check if the current model has a primary key value
        if ($this->{$this->primaryKey}) {
            // Create an instance of the related model
            $modelObject = new $model();
            // Retrieve and return the many-to-many relationship
            return $modelObject->getBelongsToManyRelation($this->table, $commonTable, $localKey, $this->$localKey, $middleForeignKey, $middleRelation, $foreignKey);
        }
    }

    /**
     * The getBelongsToManyRelation method retrieves the related models in a many-to-many relationship through an intermediate table.
     *
     * @param string $table The name of the related model's table.
     * @param string $commonTable The name of the intermediate table.
     * @param string $localKey The local key in the current model's table.
     * @param mixed $localKeyValue The value of the local key in the current model.
     * @param string $middleForeignKey The foreign key in the intermediate table pointing to the current model.
     * @param string $middleRelation The key in the intermediate table.
     * @param string $foreignKey The foreign key in the related model's table.
     * @return mixed|null The related model object if found, otherwise null.
     */
    protected function getBelongsToManyRelation($table, $commonTable, $localKey, $localKeyValue, $middleForeignKey, $middleRelation, $foreignKey)
    {
        // Construct the SQL query for retrieving the related models in a many-to-many relationship through an intermediate table
        $this->setSql("SELECT `c`.* FROM ( SELECT `b`.* FROM `{$table}` AS `a` JOIN `{$commonTable}` AS `b` on `a`.`{$localKey}` = `b`.`{$middleForeignKey}` WHERE  `a`.`{$localKey}` = ? ) AS `relation` JOIN " . $this->getTableName() . " AS `c` ON `relation`.`{$middleRelation}` = `c`.`$foreignKey`");
        $this->addValue("{$table}_{$localKey}", $localKeyValue);
        $this->table = 'c';
        // Return the current instance to allow chaining of methods
        return $this;
    }
}
