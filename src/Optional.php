<?php
declare(strict_types=1);

namespace TemirkhanN\Generic;

/**
 * @template-covariant T
 */
final class Optional
{
    private bool $initialized;

    /**
     * @var T
     */
    private $value;

    private function __construct() {}

    /**
     * @return self<T>
     */
    public static function empty(): self
    {
        $result = new self();
        $result->initialized = false;

        return $result;
    }

    /**
     * @param T $value
     *
     * @return self<T>
     */
    public static function value($value): self
    {
        $result = new self();
        $result->value = $value;
        $result->initialized = true;

        return $result;
    }

    public function isEmpty(): bool
    {
        return !$this->initialized;
    }

    /**
     * @return T
     */
    public function get()
    {
        if ($this->isEmpty()) {
            throw new Exception\RuntimeException("Can not get empty value since it was not set." .
                "Consider rewriting code using isEmpty pre-check"
            );
        }

        return $this->value;
    }
}
