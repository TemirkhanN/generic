<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

/**
 * @template T
 * @template E
 */
interface ResultInterface
{
    public function isSuccessful(): bool;

    /**
     * @return E
     */
    public function getError();

    /**
     * @return T
     */
    public function getData();
}
