<?php

/*
|--------------------------------------------------------------------------
| Framebot
|--------------------------------------------------------------------------
| PHP framework for Telegram bot development. Fast, flexible, feature-rich.
|--------------------------------------------------------------------------
| @category  Framework
| @framework Framebot
| @version   2.3.0
| @author    Alireza Javadi
| @license   MIT License
| @link      https://github.com/alirezajavadigit/framebot
|--------------------------------------------------------------------------
| System\TeleCore\Traits\Caller
|--------------------------------------------------------------------------
| This trait provides a mechanism for handling static and dynamic method calls
| using a fluent interface.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Traits;

Trait Caller
{
    /**
     * Handles static method calls using the __callStatic magic method.
     *
     * This method allows calling static methods using a fluent interface, where the method name
     * represents the property to be set. For example, `ResponseMaker::message('Hello')` is
     * equivalent to `(new ResponseMaker())->setMessage('Hello')`.
     *
     * @param string $method The name of the called method.
     * @param array $args The arguments passed to the method.
     * @return ResponseMaker Returns a new instance of the ResponseMaker class with the property set.
     */
    public static function __callStatic($method, $args)
    {
        $className = get_called_class();
        $instance = new $className;
        return $instance->methodCaller($instance, $method, $args);
    }

    /**
     * Handles dynamic method calls using the __call magic method.
     *
     * This method allows calling dynamic methods using a fluent interface, similar to the
     * __callStatic method, but for instance methods.
     *
     * @param string $method The name of the called method.
     * @param array $args The arguments passed to the method.
     * @return ResponseMaker Returns the current instance with the property set.
     */
    public function __call($method, $args)
    {
        return $this->methodCaller($this, $method, $args);
    }

    /**
     * Helper method to call the appropriate setter method based on the provided method name.
     *
     * This method is used by the __callStatic and __call magic methods to dynamically call
     * the corresponding setter method based on the provided method name. It follows a naming
     * convention where the setter method name starts with "set" followed by the capitalized
     * property name.
     *
     * @param object $object The instance of the ResponseMaker class.
     * @param string $method The name of the called method.
     * @param array $args The arguments passed to the method.
     * @return mixed Returns the result of calling the appropriate setter method.
     */
    private function methodCaller($object, $method, $args)
    {
        $suffix = 'set';
        $methodName = $suffix . strtoupper($method[0]) . substr($method, 1);
        return call_user_func_array(array($object, $methodName), $args);
    }
}
