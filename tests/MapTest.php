<?php

namespace Test\TemirkhanN\Generic;

use PHPUnit\Framework\TestCase;
use TemirkhanN\Generic\Map;

class MapTest extends TestCase
{
    public function testEmptyMap(): void
    {
        $map = new Map();

        self::assertTrue($map->isEmpty());
        self::assertEquals(0, $map->count());
        self::assertEquals([], $map->values());
    }

    public function testNonPersistentMap(): void
    {
        self::expectException(\Error::class);

        $map = new Map();

        $map->set('SomeKey', 'SomeStringValue');
        $map->set(new \stdClass(), 'AnotherStringValue');
    }

    public function testMap(): void
    {
        $map = new Map();

        $map->set('InitialEntryKey', 'InitialEntryValue');

        self::assertFalse($map->has('SomeKey'));
        self::assertNull($map->get('SomeKey'));

        $map->set('SomeKey', 'SomeValue');
        self::assertEquals('SomeValue', $map->get('SomeKey'));
        self::assertEquals(2, count($map));
        self::assertEquals(['InitialEntryValue', 'SomeValue'], $map->values());
    }
}
