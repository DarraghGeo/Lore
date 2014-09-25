<?php
/**
 * boot.php
 *
 * Initiates the application
 *
 * @package     Lore Web Publishing Software
 * @author      Darragh Geoghegan <darragh.geo@gmail.com>
 *
 */

namespace Lore\Controller;

class Boot
{
    private $loader;
    private $mainController;
    private $url;

    public function __construct($url = false, \Lore\Library\Loader $loader, $config)
    {
        $this->loader = $loader;

        $this->config = $config;

        // Create all objects and inject them.
        $this->loader->model("cabinet.php");
        $cabinet = new \Lore\Model\Cabinet($this->config["extension"]);

        $this->loader->thirdparty("Parsedown.php");
        $parsedown = new \Parsedown();

        $this->loader->library("cache.php");
        $cache = new \Lore\Library\Cache($this->config["cache"]);

        $this->loader->controller("page.php");
        $this->page = new \Lore\Controller\Page($url, $cabinet, $cache, $this->loader, $parsedown, $this->config);

        // Begin execution
        $this->run($url);
    }


    private function run($url = false)
    {
        $this->url = $url ? $url : $_SERVER["REQUEST_URI"];

        //$this->register->plugin->runInitial(&$this->url);

        if ($this->page->publish() === false) {
            die($this->loader->view("/_System/404.php"));
        }
    }

}
