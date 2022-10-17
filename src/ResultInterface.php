<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

/**
 * @template-covariant T
 */
interface ResultInterface
{
    public function isSuccessful(): bool;

    /**
     * @return ErrorInterface
     */
    public function getError(): ErrorInterface;

    /**
     * @return T
     */
    public function getData();
}
