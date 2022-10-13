<?php

declare(strict_types=1);

namespace TemirkhanN\Generic\Internal;

/**
 * @internal
 */
class Iterating
{
    /**
     * @template K of string|int
     * @template T
     *
     * @param iterable<K, T> $iterable
     * @return array<K, T>
     */
    public static function toArray(iterable $iterable, bool $preserveKeys = true): array
    {
        $result = [];
        if (!is_array($iterable)) {
            foreach ($iterable as $key => $value) {
                $result[$key] = $value;
            }
        } else {
            $result = $iterable;
        }

        if ($preserveKeys) {
            return $result;
        }

        return array_values($result);
    }
}
