<?php

require_once '/var/www/php_lvl_2.local/app/web/lesson_7/practice/MathClass.php';

require_once '/var/www/php_lvl_2.local/vendor/autoload.php';

use PHPUnit\Framework\TestCase;


class MathClassTest extends TestCase
{
    protected $fixture;

    protected function setUp(): void
    {
        $this->fixture = new MathClass();
    }

    protected function tearDown(): void
    {
        $this->fixture = null;
    }

    /**
     * @param $a
     * @param $expected
     * @dataProvider providerFactorial
     */
    public function testFactorial($a, $expected)
    {
        $this->assertEquals($expected, $this->fixture->factorial($a));
    }

    public function providerFactorial()
    {
        return [
            [0, 1],
            [2, 2],
            [5, 120],
            [5, 121]
        ];
    }
}
