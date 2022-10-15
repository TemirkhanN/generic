<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

use RuntimeException;

/**
 * @template T
 * @template E
 *
 * @implements ResultInterface<T, E>
 */
final class Result implements ResultInterface
{
    /**
     * @var ?E
     */
    private $error = null;

    /**
     * @var T
     */
    private $data;

    private function __construct()
    {
    }

    /**
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     *
     * @template DT
     *
     * @param DT $data
     *
     * @return static<DT, E>
     */
    public static function success($data = null): self
    {
        // phpcs:enable
        $result       = new self();
        $result->data = $data;

        return $result;
    }

    /**
     * @template Err
     *
     * @param Err $error
     *
     * @return static<T, Err>
     */
    public static function error($error): self
    {
        $result        = new self();
        $result->error = $error;

        return $result;
    }

    public function isSuccessful(): bool
    {
        return $this->error === null;
    }

    public function getError()
    {
        if ($this->error === null) {
            throw new RuntimeException('This is not an error result. Consider using isSuccessful');
        }

        return $this->error;
    }

    public function getData()
    {
        if(!$this->isSuccessful()) {
            throw new RuntimeException('This is an error result. Consider using isSuccessful.');
        }

        return $this->data;
    }
}
