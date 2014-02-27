<?php if ( ! defined("BASE_PATH")) die("No direct access.");

/**
 * cache.php
 *
 * Provide caching functionality.
 *
 * @package     Lore Web Publishing Software
 * @author      Darragh Geoghegan <darragh.geo@gmail.com>
 */

class Cache
{
    private $expiry;

    
    /**
     * @access  public
     * @param   expiry  The number of minutes a cached file is valid
     * @return  null
     */
    public function __construct($expiry)
    {
        $this->expiry = $expiry;
    }


    /**
     * @access  public
     * @param   title   The URL for the requested page
     * @return  str     Returns string or FALSE on failure
     */
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


    /**
     * @access  public
     * @param   title   URI of the requested page
     * @param   content Content to be cached
     * @return  bool
     */
    public function write($title, $content)
    {
        $title = md5($title);
        $content = preg_replace('~>\s+<~', '><', $content);

        return file_put_contents(CACHE_PATH . $title, $content);
    }

}
