<?php

class Page
{
    private $url;
    private $exploded_url;
    private $path;
    private $register;

    public function __construct($url, $register)
    {
        $this->url = $url;
        $this->exploded_url = explode("/", $url);
        $this->path = substr($this->url, 0, 1) === "/" ? substr($this->url, 1) : $this->url;
        $this->register = $register;

        $this->_publish();
    }


    private function _publish()
    {
        if ($this->_is_directory())
        {
            $max = $this->register->config["per_page"];

            if(is_numeric(end($this->exploded_url)))
            {
                $offset = $max * (end($this->exploded_url));
                $this->path = substr($this->url, 0, strrpos($this->url, "/"));
            }
            else
            {
                $offset = 0;
            }
        }
        else
        {
            $max = 1;
            $offset = 0;
        }

        if ($this->register->config["cache"])
        {
            if ($cache = $this->register->cache->get($this->url))
            {
                exit($cache);
            }
        }


        ob_start();


        $content = $this->_content($max, $offset);

        $view = $this->_view($content);

        if ($this->register->config["cache"] && $content)
        {
            $this->register->cache->write($this->url, ob_get_contents());
        }


        ob_end_flush();


        return TRUE;

    }


    private function _content($max, $off)
    {
        $this->register->load->model("model.php");
        $model = new model($this->register->config["extension"]);

        $this->register->load->thirdparty("Parsedown.php");
        $parsedown = new Parsedown;

        
        if ($files = $model->get($this->path, $max, $off))
        {
            for ($i = 0; $i < count($files); $i++)
            {
                $files[$i] = $parsedown->parse($files[$i]);
            }
        }

        return $files;
    }


    private function _view($content)
    {
        $values["article"] = $content;


        if ( ! $this->_is_directory())
        {
            $path = substr($this->path, 0, strrpos($this->path, "/") + 1);
        }
        else
        {
            $path = $this->path;
        }


        if ( ! $this->register->load->view($path . "header.php"))
            $this->register->load->view("header.php");

        if ( ! $this->register->load->view($path . "read.php", $values))
            $this->register->load->view("read.php", $values);

        if( ! $this->register->load->view($path . "footer.php"))
            $this->register->load->view("footer.php");


        return TRUE;
    }



    private function _is_directory()
    {
        $exploded = explode("/", $this->url);

        if (substr($this->url, -1) === "/" || is_numeric(end($exploded)))
        {
            return TRUE;
        }

        return FALSE;
    }

}

