<?php

/**
 * cache.php
 *
 * Provide caching functionality.
 *
 * @package     Lore Web Publishing Software
 * @author      Darragh Geoghegan <darragh.geo@gmail.com>
 */

namespace Lore\Library;

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
        if ($this->isCached($title) && $this->isCurrent($title)) {
                $contents = file_get_contents(CACHE_PATH . md5($title));
                if ($contents == true) {
                    return $contents;
                }
        }

        return false;
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

    public function isCached($title)
    {
        return file_exists(CACHE_PATH . md5($title));
    }

    public function isCurrent($title)
    {
        $modifiedMinutesAgo = (time() - filemtime(CACHE_PATH . md5($title))) / 60;
        if ($modifiedMinutesAgo < $this->expiry) {
            return true;
        } else {
            return false;
        }
    }

}
