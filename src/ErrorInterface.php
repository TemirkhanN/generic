<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

interface ErrorInterface
{
    public function getMessage(): string;

    public function getCode(): int;
    /**
     * Debug or optional information that helps to clarify the case
     *
     * @return array<mixed>
     */
    public function getDetails(): array;
}
