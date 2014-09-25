<?php

include(dirname(__FILE__) . "../../../Library/cache.php");

class Cache extends PHPUnit_Framework_TestCase
{
    private $cacheDir;
    private $title = "/test/file";
    private $content = "ASDFASDFASDFASDFASDF";
    private $fakeTitle = "/fake/test/file";

    public function setUp() {
        $this->cache = new \Lore\Library\Cache(20);

        // Defined here as __DIR__ can't be appended to in initial decleration
        $this->cacheDir = __DIR__ . "/../../Cache/";
    }

    public function testRequestedContentCaches()
    {
        $this->cache->write($this->title, $this->content);

        $this->assertFileExists($this->cacheDir . md5($this->title));
    }

    public function testRequestedCachedFileDoesNotExist() 
    {
        $this->assertFalse($this->cache->get($this->fakeTitle));
    }

    public function testRequestedCachedFileExists()
    {
        $this->assertStringMatchesFormat("%S",$this->cache->get($this->title));
    }
}

