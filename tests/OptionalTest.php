<?php
declare(strict_types=1);

namespace Test\TemirkhanN\Generic;

use PHPUnit\Framework\TestCase;
use TemirkhanN\Generic\Exception\RuntimeException;
use TemirkhanN\Generic\Optional;

class OptionalTest extends TestCase
{
    public function testEmptyValue(): void
    {
        $result = Optional::empty();

        self::assertTrue($result->isEmpty());

        $this->expectException(RuntimeException::class);

        $result->get();
    }

    /**
     * @param mixed $value
     *
     * @return void
     *
     * @dataProvider valueProvider
     */
    public function testValue($value): void
    {
        $result = Optional::value($value);

        self::assertFalse($result->isEmpty());

        self::assertSame($value, $result->get());
    }

    public static function valueProvider(): iterable
    {
        yield 'string value' => ['SomeString'];
        yield 'int value' => [123];
        yield 'float value' => [123.45];
        yield 'numeric value value' => ['123'];
        yield 'object' => [new \stdClass()];
        yield 'null value' => [null];
    }
}
