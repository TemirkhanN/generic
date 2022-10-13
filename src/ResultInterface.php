<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

/**
 * @template T
 */
interface ResultInterface
{
    public function isSuccessful(): bool;

    public function getError(): string;

    /**
     * @return T
     */
    public function getData();
}
