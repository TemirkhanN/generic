<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

use RuntimeException;

/**
 * @template-covariant T
 *
 * @implements ResultInterface<T>
 */
final class Result implements ResultInterface
{
    private ErrorInterface $error;

    /**
     * @var T
     */
    private $data;

    private function __construct()
    {
        $this->error = Error::none();
    }

    /**
     * @template DT
     *
     * @param DT $data
     *
     * @return static<DT>
     */
    public static function success($data = null): self
    {
        $result       = new self();
        $result->data = $data;

        return $result;
    }

    /**
     * @param ErrorInterface $error
     *
     * @return self<mixed>
     */
    public static function error(ErrorInterface $error): self
    {
        $result        = new self();
        $result->error = $error;

        return $result;
    }

    public function isSuccessful(): bool
    {
        return $this->error->getMessage() === '';
    }

    public function getError(): ErrorInterface
    {
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
