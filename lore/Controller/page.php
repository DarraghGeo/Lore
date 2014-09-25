<?php 
/**
 * page.php
 *
 * Primary controller to render the page to the screen/broswer
 *
 * @package     Lore Web Publishing Software
 * @author      Darragh Geoghegan <darragh.geo@gmail.com>
 */

namespace Lore\Controller;

class Page
{
    private $url;
    private $path;
    private $directory;
    private $file;
    private $type;
    private $page;
    private $parser;
    private $cabinet;
    private $cache;
    private $config;


    /**
     * @access  public
     * @param   url         The requested URI
     * @param   register    Register containing useful objects
     * @return  bool
     */
    public function __construct($url, $cabinet, $cache, $loader, $parser, $config)
    {
        $this->url = substr($url, 1);
        $this->path = substr($this->url, 0, 1) === "/" ? substr($this->url, 1) : $this->url;

        $this->cabinet = $cabinet;
        $this->cache = $cache;
        $this->load = $loader;
        $this->parser = $parser;
        $this->config = $config;
    }

    /**
     * @access  public
     * @return  bool
     */
    public function publish()
    {
        if ($this->config["cache"]) {
            if ($this->cache->isCached($this->url)) {
                return $this->cache->get($this->url);
            }
        }

        if ($this->setRequest() === false) {
            return false;
        }

        $max = $this->config["per_page"];
        $offset = ($this->page - 1) * $max;

        ob_start();

        $content = $this->content($max, $offset);

        if ($content === false) {
            return false;
        }

        $view = $this->view($content);

        $page = ob_get_contents();

        if ($this->config["cache"] && $content !== false) {
            $this->cache->write($this->url, $page);
        }

        ob_end_flush();

        return true;
    }

    /**
     * @access  private
     * @param   max     The maximum number of articles to be published if listing them
     * @param   offset  Offset of articles
     * @return  arr     Array of articles
     */
    private function content($max, $offset)
    {
        if ($files = $this->cabinet->get($this->path, $max, $offset)) {
            for ($i = 0; $i < count($files); $i++) {
                $files[$i] = $this->parser->parse($files[$i]);
            }
        }

        return $files;
    }

    /**
     * @access  private
     * @param   content Content to be used in the view
     * @return  bool
     */
    private function view($content, $view = false)
    {
        $values["article"] = $content;

        if ($this->type === "directory") {
            $view = $this->directory . "default.php";
        } else {
            $view = $this->url . ".php";
        }

        if ($this->load->view($view, $values) === false) {
            if ($this->load->view($this->config["default_view"], $values) === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * @access  private
     * @return  bool
     */
    private function setRequest()
    {
        $exploded = explode("/", $this->url);

        if (end($exploded) === "") {
            $this->directory = substr($this->url, 1);
            $this->file = null;
            $this->page = 0;
            $this->type = "directory";
            return true;
        } elseif (is_numeric(end($exploded))) {
            $this->page = end($exploded);
            array_pop($exploded);
            $this->directory = substr(implode("/", $exploded) . "/", 1);
            $this->file = null;
            $this->type = "directory";
            return true;
        } else {
            $this->file = end($exploded);
            array_pop($exploded);
            $this->directory = substr(implode("/", $exploded) . "/", 1);
            $this->page = 0;
            $this->type = "file";
            return true;
        }

        return false;
    }
}

