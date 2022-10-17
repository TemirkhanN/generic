<?php

declare(strict_types=1);

namespace TemirkhanN\Generic\Internal;

/**
 * @internal
 */
class Iterating
{
    /**
     * @template T
     *
     * @param iterable<T> $iterable
     *
     * @return array<T>
     */
    public static function toArray(iterable $iterable): array
    {
        $result = [];
        if (!is_array($iterable)) {
            foreach ($iterable as $key => $value) {
                $result[$key] = $value;
            }
        } else {
            $result = $iterable;
        }

        return array_values($result);
    }
}
