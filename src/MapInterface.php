<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

use Countable;
use IteratorAggregate;

/**
 * @template Key
 * @template Val
 *
 * @extends IteratorAggregate<Key, Val>
 */
interface MapInterface extends Countable, IteratorAggregate
{
    /**
     * @param Key $key
     *
     * @return ?Val
     */
    public function get($key);

    /**
     * @param Key $key
     *
     * @return bool
     */
    public function has($key): bool;

    /**
     * @param Key $key
     * @param Val $element
     *
     * @return void
     */
    public function set($key, $element): void;

    public function isEmpty(): bool;

    public function count(): int;

    /**
     * @return Val[]
     */
    public function values(): array;
}
