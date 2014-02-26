<?php

include(SYS_PATH . 'Controller/LORE_Controller.php');

class Login extends LORE_Controller
{

    public function __construct($config, $loader)
    {

        parent::__construct($config, $loader);

        $this->login();

    }

    public function login()
    {

        $values["placeholder"] = "Password";

        //  If we don't need a password.
        if ($this->config["protected"] === FALSE)
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
            if (md5($_POST["password"]) === $this->config["password"])
            {
                $_SESSION["timestamp"] = time();

                return TRUE;
            }
            else
            {
                $values["placeholder"] = "Try Again";
            }
        }


        $this->add_buffer('login.php', $values);
    }

}


