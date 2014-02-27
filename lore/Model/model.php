<?php if ( ! defined("BASE_PATH")) die("No direct access.");

/**
 * model.php
 *
 * Retrieves requested files
 *
 * @package     Lore Web Publishing Software
 * @author      Darragh Geoghegan <darragh.geo@gmail.com>
 */


class Model
{

    private $extension;


    /*
     * @access  public
     * @param   dir     Directory containing files
     * @param   ext     File extensions
     * @return  null
     */
    public function __construct($extension)
    {
        $this->extension = $extension;
    }


    /**
     * @access  public
     * @param   path    Path to requested file
     * @param   max     Maximum number of files to return
     * @param   offset  How to offset the returned files
     * @return  array   Returns array of files or FALSE if empty
     */
    public function get($path, $max, $offset)
    {
        $contents = array();

        $path = CONT_PATH . $path;

        if (is_dir($path))
        {
            $i = 0;
            $directory = opendir($path);

            substr($path, -1) === "/" || $path .= "/";

            while (($file = readdir($directory)) !== false)
            {
                if (filetype($path . $file) === 'file' && substr($file,strlen($this->extension) * -1) === $this->extension)        
                {
                    if ($max > 0 && $i >= $offset)
                    {
                        $contents[] = file_get_contents($path . $file);

                        $max--;
                    }
                    $i++;
                }
            }
            closedir($directory);
        }
        else if (is_file($path . "." . $this->extension))
        {
            $contents[] = file_get_contents($path . "." . $this->extension);
        }

        return count($contents) > 0 ? $contents : FALSE;
    }

}
