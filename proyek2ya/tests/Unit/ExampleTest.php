<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Test that false is false.
     */
    public function test_that_false_is_false(): void
    {
        $this->assertFalse(false);
    }

    /**
     * Test that two strings are equal.
     */
    public function test_string_equality(): void
    {
        $this->assertEquals('Hello', 'Hello');
    }

    /**
     * Test that an array contains a specific value.
     */
    public function test_array_contains_value(): void
    {
        $array = [1, 2, 3];
        $this->assertContains(2, $array);
    }

    /**
     * Test that an array does not contain a specific value.
     */
    public function test_array_does_not_contain_value(): void
    {
        $array = [1, 2, 3];
        $this->assertNotContains(4, $array);
    }
}
