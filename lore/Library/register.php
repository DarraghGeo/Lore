<?php

class Register
{
    private static $instance = NULL;
    private $registry = array();


    private function __construct()
    {
    }

    public static function getInstance()
    {

        if (self::$instance === NULL)
        {
            self::$instance  = new self;
        }

        return self::$instance;

    }


    public function __set($key, $value)
    {
        if ( ! isset($this->registry[$key]))
        {
            $this->registry[$key] = $value;
        }
    }


    public function __get($key)
    {
        if (isset($this->registry[$key]))
        {
            return $this->registry[$key];
        }
        else
        {
            return FALSE;
        }
    }
}



