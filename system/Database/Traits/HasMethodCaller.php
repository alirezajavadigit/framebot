<?php

namespace System\Database\Traits;

/**
 * The HasMethodCaller trait provides dynamic method calling functionality for classes.
 */
trait HasMethodCaller
{
  // Array containing all available methods
  private $allMethods = ['create', 'update', 'delete', 'find', 'all', 'save', 'where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate'];

  // Array containing allowed methods for method calling
  private $allowedMethods = ['create', 'update', 'delete', 'find', 'all', 'save', 'where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate'];

  /**
   * Magic method to handle dynamic method calls on the object instance.
   *
   * @param string $method The name of the method being called.
   * @param array $args An array of arguments passed to the method.
   * @return mixed Returns the result of the method call.
   */
  public function __call($method, $args)
  {
    return $this->methodCaller($this, $method, $args);
  }

  /**
   * Magic method to handle dynamic method calls in a static context.
   *
   * @param string $method The name of the method being called.
   * @param array $args An array of arguments passed to the method.
   * @return mixed Returns the result of the method call.
   */
  public static function __callStatic($method, $args)
  {
    // Get the name of the calling class
    $className = get_called_class();

    // Create a new instance of the calling class
    $instance = new $className;

    // Call the methodCaller function with the instance, method name, and arguments
    return $instance->methodCaller($instance, $method, $args);
  }

  /**
   * Calls the specified method on the object with the provided arguments.
   *
   * @param object $object The object on which the method is being called.
   * @param string $method The name of the method being called.
   * @param array $args An array of arguments passed to the method.
   * @return mixed Returns the result of the method call.
   */
  private function methodCaller($object, $method, $args)
  {
    // Append the suffix 'Method' to the method name
    $suffix = 'Method';
    $methodName = $method . $suffix;

    // Check if the method is allowed for calling
    if (in_array($method, $this->allowedMethods)) {
      // Call the specified method on the object with the provided arguments
      return call_user_func_array(array($object, $methodName), $args);
    }
  }

  /**
   * Sets the allowed methods for method calling.
   *
   * @param array $array An array containing the names of allowed methods.
   * @return void
   */
  protected function setAllowedMethods($array)
  {
    $this->allowedMethods = $array;
  }
}
