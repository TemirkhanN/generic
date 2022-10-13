<?php

declare(strict_types=1);

namespace TemirkhanN\Generic\Collection;

use TemirkhanN\Generic\Internal;
use Traversable;

/**
 * @template   T
 * @implements CollectionInterface<T>
 */
final class Collection implements CollectionInterface
{
    /**
     * @var array<T>
     */
    private array $items;

    /**
     * @param iterable<string|int, T> $items
     */
    public function __construct(iterable $items)
    {
        $this->items = Internal\Iterating::toArray($items, false);
    }

    /**
     * @return Traversable<int, T>
     */
    public function getIterator(): Traversable
    {
        yield from $this->items;
    }

    /**
     * @return array<int, T>
     */
    public function items(): array
    {
        return Internal\Iterating::toArray($this->getIterator(), false);
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
