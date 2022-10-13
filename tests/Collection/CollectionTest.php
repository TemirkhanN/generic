<?php

declare(strict_types=1);

namespace Test\TemirkhanN\Generic\Collection;

use PHPUnit\Framework\TestCase;
use TemirkhanN\Generic\Collection\Collection;
use TemirkhanN\Generic\Collection\CollectionInterface;
use TemirkhanN\Generic\Internal\Iterating;

class CollectionTest extends TestCase
{
    public function testEmptyCollection(): void
    {
        $collection = new Collection([]);

        self::assertEquals(0, $collection->size());
        self::assertEquals([], $collection->items());
    }

    public function testArrayCollection(): void
    {
        $collection = new Collection(['key' => 'value', 34 => 'another value']);

        self::assertEquals(2, $collection->size());
        self::assertEquals(['value', 'another value'], $collection->items());
        self::assertIterableEqualsToArray(['value', 'another value'], $collection);
    }

    public static function assertIterableEqualsToArray(array $expected, iterable $actual): void
    {
        self::assertEquals($expected, Iterating::toArray($actual));
    }
}
