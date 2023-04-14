<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

use IteratorAggregate;
use Traversable;

/**
 * @template-covariant T
 * @extends IteratorAggregate<array-key, T>
 */
interface CollectionInterface extends IteratorAggregate
{
    public function isEmpty(): bool;

    /**
     * @return array<T>
     */
    public function items(): array;

    /**
     * @return Traversable<array-key, T>
     */
    public function getIterator(): Traversable;

    public function size(): int;
}
