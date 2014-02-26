<?php

class LORE_Controller
{
    protected $R;
    protected $config;

    private $buffer = FALSE;

    protected function __construct($R)
    {
        $this->R = $R;
    }


    protected function add_buffer($file, $values = NULL)
    {
        if (! $this->buffer)
        {
            ob_start();
            $this->buffer = TRUE;
        }


        $this->R->load->view($file, $values);
    }

}
