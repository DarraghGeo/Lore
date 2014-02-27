<?php if ( ! defined("BASE_PATH")) die("No direct access.");

/**
 * login.php
 * 
 * Provide simple login functionality if required.
 *
 * @package     Lore Web Publishing Software 
 * @author      Darragh Geoghegan <darragh.geo@gmail.com>
 */


class Login 
{

    private $register;


    /**
     * @access  public
     * @param   register    Register containing various objects
     * @return  null
     */
    public function __construct($register)
    {

        $this->register = $register;

        $this->login();

    }


    /**
     * @access  public
     * @return  bool
     */
    public function login()
    {

        $values["placeholder"] = "Password";

        //  If we don't need a password.
        if ($this->register->config["protected"] === FALSE)
        {
            return TRUE;
        }


        // If we're already logged in.
        if (isset($_SESSION["timestamp"]))
        {
            return TRUE;
        }


        // If we're trying to log in.
        if (isset($_POST["password"]))  
        {
            // If we're successful.
            if (md5($_POST["password"]) === $this->register->config["password"])
            {
                $_SESSION["timestamp"] = time();

                return TRUE;
            }
            else
            {
                $values["placeholder"] = "Try Again";
            }
        }


        $this->register->load->view("login.php");
    }

}


