<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

use Traversable;

/**
 * @template Key
 * @template Val
 * @implements MapInterface<Key,Val>
 */
final class Map implements MapInterface
{
    private const KEY_TYPE_UNDEFINED = 0;
    private const KEY_TYPE_STRING = 1;
    private const KEY_TYPE_STRING_CAST = 2;
    private const KEY_TYPE_OBJECT = 3;

    /**
     * @var array<array{key: Key, value: Val}>
     */
    private array $entries = [];

    private int $keyType = self::KEY_TYPE_UNDEFINED;

    /**
     * @param Key $key
     *
     * @return ?Val
     */
    public function get($key)
    {
        $data = $this->entries[$this->getKeyHash($key)] ?? null;

        if ($data === null) {
            return null;
        }

        return $data['value'];
    }

    /**
     * @param Key $key
     *
     * @return bool
     */
    public function has($key): bool
    {
        return array_key_exists($this->getKeyHash($key), $this->entries);
    }

    /**
     * @param Key $key
     * @param Val $element
     *
     * @return void
     */
    public function set($key, $element): void
    {
        $this->entries[$this->getKeyHash($key)] = ['key' => $key, 'value' => $element];
    }

    public function isEmpty(): bool
    {
        return $this->entries === [];
    }

    public function count(): int
    {
        return count($this->entries);
    }

    /**
     * @return Val[]
     */
    public function values(): array
    {
        return array_column($this->entries, 'value');
    }

    /**
     * @return Traversable<Key, Val>
     */
    public function getIterator(): Traversable
    {
        foreach ($this->entries as $entry) {
            yield $entry['key'] => $entry['value'];
        }
    }

    /**
     * @param Key $key
     *
     * @return string
     */
    private function getKeyHash($key): string
    {
        $this->detectKeyType($key);

        switch ($this->keyType) {
            case self::KEY_TYPE_STRING:
            case self::KEY_TYPE_STRING_CAST:
                return (string) $key;
            case self::KEY_TYPE_OBJECT:
                return md5(serialize($key));
            default:
                throw new Exception\RuntimeException('Unreachable statement');
        }
    }

    /**
     * @param Key $key
     *
     * @return void
     */
    private function detectKeyType($key): void
    {
        if ($this->keyType !== self::KEY_TYPE_UNDEFINED) {
            return;
        }

        if (is_scalar($key)) {
            $this->keyType = self::KEY_TYPE_STRING;

            return;
        }

        if (!is_object($key)) {
            throw new Exception\RuntimeException(sprintf('Dictionary key can not be of type %s', gettype($key)));
        }

        if (method_exists($key, '__toString')) {
            $this->keyType = self::KEY_TYPE_STRING_CAST;

            return;
        }

        $this->keyType = self::KEY_TYPE_OBJECT;
    }
}
