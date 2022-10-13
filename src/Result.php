<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

/**
 * @template T
 * @implements ResultInterface<T>
 */
final class Result implements ResultInterface
{
    private string $error = '';

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
     * @param T $data
     *
     * @return static<T>
     */
    public static function success($data = null): self
    {
        // phpcs:enable
        $result       = new self();
        $result->data = $data;

        return $result;
    }

    /**
     * @param string $error
     *
     * @return static<T>
     */
    public static function error(string $error): self
    {
        if ($error === '') {
            throw new Exception\RuntimeException('Error shall contain some valid(non-empty) message');
        }

        $result        = new self();
        $result->error = $error;

        return $result;
    }

    public function isSuccessful(): bool
    {
        return $this->error === '';
    }

    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @return T
     */
    public function getData()
    {
        if(!$this->isSuccessful()) {
            throw new \RuntimeException('This is an error result. It contains no data.');
        }

        return $this->data;
    }
}
