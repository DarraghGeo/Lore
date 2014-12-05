<?php

include(dirname(__FILE__) . "../../../Library/loader.php");

class Loader extends PHPUnit_Framework_TestCase
{

    public function setUp() {
        $this->object = \Lore\Library\Loader::getInstance();
    }

    public function testCachedFileIsNotFound() 
    {
        $this->assertFalse($this->object->get("filename.md"));
    }
}
