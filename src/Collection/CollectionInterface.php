<?php

declare(strict_types=1);

namespace TemirkhanN\Generic\Collection;

use IteratorAggregate;
use Traversable;

/**
 * @template-covariant T
 * @extends IteratorAggregate<T>
 */
interface CollectionInterface extends IteratorAggregate
{
    public function isEmpty(): bool;

    /**
     * @return array<T>
     */
    public function items(): array;

    /**
     * @return Traversable<T>
     */
    public function getIterator(): Traversable;

    public function size(): int;
}
