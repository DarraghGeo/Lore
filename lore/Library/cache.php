<?php

class Cache
{
    private $expiry;

    
    public function __construct($expiry)
    {
        $this->expiry = $expiry;
    }


    public function get($title)
    {
        $title = md5($title);

        if (file_exists(CACHE_PATH . $title))
        {
            if (((time() - filemtime(CACHE_PATH . $title)) / 60) < $this->expiry)
            {
                return file_get_contents(CACHE_PATH . $title);
            }
        } 

        return FALSE;
    }


    public function write($title, $content)
    {
        $title = md5($title);
        $content = preg_replace('~>\s+<~', '><', $content);

        return file_put_contents(CACHE_PATH . $title, $content);
    }

}
