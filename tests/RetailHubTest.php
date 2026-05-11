<?php

namespace Tests;

use CodeIgniter\Test\CIUnitTestCase;

final class RetailHubTest extends CIUnitTestCase
{
    public function testTrueIsTrue()
    {
        $this->assertTrue(true);
    }

    public function testMathOne()
    {
        $this->assertEquals(2, 1 + 1);
    }

    public function testMathTwo()
    {
        $this->assertEquals(4, 2 + 2);
    }

    public function testString()
    {
        $this->assertStringContainsString('Hub', 'Retail Hub');
    }

    public function testArray()
    {
        $this->assertIsArray([]);
    }
}