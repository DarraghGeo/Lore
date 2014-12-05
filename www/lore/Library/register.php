<?php 
/**
 * register.php
 *
 * Hold objects used throughout the application
 *
 * @package     Lore Web Publishing Software
 * @author      Darragh Geoghegan <darragh.geo@gmail.com>
 */

namespace Lore\Library;

class Register
{
    private static $instance = NULL;
    private $registry = array();

    /**
     * @access  private To allow singleton pattern
     * @return  null
     */
    private function __construct()
    {
    }

    /**
     * @access  public
     * @return  object  Returns instance of self
     */
    public static function getInstance()
    {
        if (self::$instance === NULL) {
            self::$instance = new self;
        }

        return self::$instance;
    }


    /**
     * @access  public
     * @param   key     Reference name of object/array to be stored
     * @param   value   Object/array to be stored
     * @return  bool
     */
    public function __set($key, $value)
    {
        if (isset($this->registry[$key]) === false) {
            $this->registry[$key] = $value;
        }

        return true;
    }


    /**
     * @access  public
     * @param   key     Reference name of object/array to be returned
     * @return  obj/arr Returns object or array, or FALSE on failure
     */
    public function __get($key)
    {
        if (isset($this->registry[$key]) === true) {
            return $this->registry[$key];
        }
       
        return false;
    }
}



