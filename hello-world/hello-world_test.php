<?php

require "hello-world.php";

class HelloWorldTest extends PHPUnit\Framework\TestCase
{
    public function testHelloWorld()
    {
        $this->assertEquals('Hello, World!', helloWorld());
    }
}

// php/hello-world/hello-world_test.php