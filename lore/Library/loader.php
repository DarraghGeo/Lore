<?php if ( ! defined("BASE_PATH")) die("No direct access.");

/**
 * loader.php
 *
 * Interface for including necessary pages.
 *
 * @package     Lore Web Publishing Software
 * @author      Darragh Geoghegan <darragh.geo@gmail.com>
 *
 */

class Loader
{
    private static $instance = NULL;
    private $file;


    /**
     * @access  private Made private to enable singleton pattern
     * @return  null
     */
    private function __construct()
    {

    }


    /**
     * @access  public  Returns instance of singleton
     * @return  object
     */
    public static function getInstance()
    {
        if (!self::$instance) {

                self::$instance = new self();

        }

        return self::$instance;
     }


    /**
     * @access  private
     * @access  v       Values to be used in loaded page
     * @return  bool
     */
    private function load($v = NULL)
    {
        if (file_exists($this->file))
        {
            require($this->file);

            return TRUE;
        }

        return FALSE;
    }


    /**
     * @access  public
     * @param   name    Name of the file to be included
     * @return  bool
     */
    public function model($name)
    {
        $this->file = SYS_PATH . 'Model/' . $name;

        return $this->load();
    }


    /**
     * @access  public
     * @param   name    Name of the file to be included
     * @return  bool
     */
    public function library($name)
    {
        $this->file = SYS_PATH . "Library/" . $name;

        return $this->load();
    }


    /**
     * @access  public
     * @param   name    Name of the file to be included
     * @return  bool
     */
    public function thirdparty($name)
    {
        $this->file = SYS_PATH . "ThirdParty/" . $name;

        return $this->load();
    }


    /**
     * @access  public
     * @param   name    Name of the file to be included
     * @param   v       Values to be in the view
     * @return  bool
     */
    public function view($name, $v = NULL)
    {
        $this->file = SYS_PATH . "View/" . $name;

        return $this->load($v);
    }


    /**
     * @access  public
     * @param   name    Name of the file to be included
     * @return  bool
     */
    public function controller($name)
    {
        $this->file = SYS_PATH . "Controller/" . $name;

        return $this->load();
   }

    /**
     * @access  public
     * @param   name    Name of the file to be included
     * @return  bool
     */
   public function config($name)
   {
       $this->file = SYS_PATH . "Config/" . $name;

       return $this->load();
   }

}
