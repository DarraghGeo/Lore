<?php

class Loader
{
    private static $instance = NULL;
    private $file;


    private function __construct()
    {

    }


    public static function getInstance()
    {
        if (!self::$instance) {

                self::$instance = new self();

        }

        return self::$instance;
     }


    private function load($v = NULL)
    {
        if (file_exists($this->file))
        {
            require($this->file);

            return TRUE;
        }

        return FALSE;
    }


    public function model($name)
    {
        $this->file = SYS_PATH . 'Model/' . $name;

        return $this->load();
    }


    public function library($name)
    {
        $this->file = SYS_PATH . "Library/" . $name;

        return $this->load();
    }


    public function thirdparty($name)
    {
        $this->file = SYS_PATH . "ThirdParty/" . $name;

        return $this->load();
    }


    public function view($name, $v = NULL)
    {
        $this->file = SYS_PATH . "View/" . $name;

        return $this->load($v);
    }


    public function controller($name)
    {
        $this->file = SYS_PATH . "Controller/" . $name;

        return $this->load();
   }

   public function config($name)
   {
       $this->file = SYS_PATH . "Config/" . $name;

       return $this->load();
   }

}
