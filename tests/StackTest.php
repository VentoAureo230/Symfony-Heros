<?php

use PHPUnit\Framework\TestCase;

final class StackTest extends TestCase
{
    public function testEmpty(): array
    {
        $stack = [];
        $this->assertEmpty($stack);

        return $stack;
    }
    /**
    * @depends testEmpty
    */

    public function testPush(array $stack): array
    {
        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1], "Attention les messages ne correspondent pas");
        $this->assertNotEmpty($stack);

        return $stack;
    }

    /**
    * @depends testPush
    */

    public function testPop(array $stack): void
    {
        $this->assertSame('foo', array_pop($stack));
        $this->assertEmpty($stack);
    }

    public function testPop(array $stack): void
    {
        $this->assertSame('foo', array_pop($stack));
        $this->assertEmpty($stack);
    }   
}




