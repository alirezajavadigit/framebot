<?php

namespace System\Database\Traits;

/**
 * The trait for managing model attributes.
 *
 * This trait provides methods for registering attributes, converting arrays to model attributes,
 * converting arrays to model objects, handling hidden attributes, managing casted attributes,
 * decoding casted attribute values, encoding casted attribute values, and encoding arrays with casted values.
 */
trait HasAttributes
{
    /**
     * Registers an attribute to the given object, applying casting if specified.
     *
     * @param object $object The object to register the attribute to.
     * @param string $attribute The name of the attribute.
     * @param mixed $value The value of the attribute.
     * @return void
     */
    private function registerAttribute($object, string $attribute, $value)
    {
        // Check if the attribute is casted and apply casting if needed
        $this->inCastsAttributes($attribute) == true ? $object->$attribute = $this->castDecodeValue($attribute, $value) : $object->$attribute = $value;
    }

    /**
     * Converts an array to model attributes.
     *
     * @param array $array The array of attributes.
     * @param object|null $object The object to assign attributes to. If null, a new object is created.
     * @return object The object with assigned attributes.
     */
    protected function arrayToAttributes(array $array, $object = null)
    {
        // Create a new object if not provided
        if (!$object) {
            $className = get_called_class();
            $object = new $className;
        }

        // Iterate through the array and register attributes to the object
        foreach ($array as $attribute => $value) {
            // Skip hidden attributes
            if ($this->inHiddenAttributes($attribute)) {
                continue;
            }
            $this->registerAttribute($object, $attribute, $value);
        }

        return $object;
    }

    /**
     * Converts an array of arrays to model objects and assigns them to the collection property.
     *
     * @param array $array The array of arrays containing attributes.
     * @return void
     */
    protected function arrayToObjects(array $array)
    {
        $collection = [];

        // Convert each array to a model object and add it to the collection
        foreach ($array as $value) {
            $object = $this->arrayToAttributes($value);
            array_push($collection, $object);
        }

        $this->collection = $collection;
    }

    /**
     * Checks if an attribute is listed in the hidden attributes.
     *
     * @param string $attribute The name of the attribute.
     * @return bool True if the attribute is hidden, false otherwise.
     */
    private function inHiddenAttributes($attribute)
    {
        return in_array($attribute, $this->hidden);
    }

    /**
     * Checks if an attribute is listed in the casted attributes.
     *
     * @param string $attribute The name of the attribute.
     * @return bool True if the attribute is casted, false otherwise.
     */
    private function inCastsAttributes($attribute)
    {
        return in_array($attribute, array_keys($this->casts));
    }

    /**
     * Decodes a casted attribute value based on its type.
     *
     * @param string $attributeKey The name of the attribute.
     * @param mixed $value The value to decode.
     * @return mixed The decoded value.
     */
    private function castDecodeValue($attributeKey, $value)
    {
        if ($this->casts[$attributeKey] == 'array' || $this->casts[$attributeKey] == 'object') {
            return unserialize($value);
        }

        return $value;
    }

    /**
     * Encodes a value of a casted attribute based on its type.
     *
     * @param string $attributeKey The name of the attribute.
     * @param mixed $value The value to encode.
     * @return mixed The encoded value.
     */
    private function castEncodeValue($attributeKey, $value)
    {
        if ($this->casts[$attributeKey] == 'array' || $this->casts[$attributeKey] == 'object') {
            return serialize($value);
        }

        return $value;
    }

    /**
     * Encodes an array with casted attribute values.
     *
     * @param array $values The array of attribute values.
     * @return array The encoded array with casted values.
     */
    private function arrayToCastEncodeValue($values)
    {
        $newArray = [];

        // Iterate through the array and encode values with casting if needed
        foreach ($values as $attribute => $value) {
            $this->inCastsAttributes($attribute) == true ? $newArray[$attribute] = $this->castEncodeValue($attribute, $value) : $newArray[$attribute] = $value;
        }

        return $newArray;
    }
}
