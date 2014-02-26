<?php


class Model
{

    private $extension;


    /*
     * @access  public
     * @param   dir     Directory containing files
     * @param   ext     File extensions
     * @return  NULL
     */
    public function __construct($extension)
    {
        $this->extension = $extension;
    }


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
