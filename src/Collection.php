<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

use TemirkhanN\Generic\Internal;
use Traversable;

/**
 * @template-covariant T
 * @implements CollectionInterface<T>
 */
final class Collection implements CollectionInterface
{
    /**
     * @var array<T>
     */
    private array $items;

    /**
     * @param iterable<array-key, T> $items
     */
    public function __construct(iterable $items)
    {
        $this->items = Internal\Iterating::toArray($items);
    }

    /**
     * @return Traversable<array-key, T>
     */
    public function getIterator(): Traversable
    {
        yield from $this->items;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function isEmpty(): bool
    {
        return $this->items === [];
    }

    public function size(): int
    {
        return count($this->items);
    }
}
