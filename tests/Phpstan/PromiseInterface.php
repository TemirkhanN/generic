<?php

declare(strict_types=1);

namespace Test\TemirkhanN\Generic\Phpstan;

use DateTimeInterface;

interface PromiseInterface
{
    public function name(): string;
    public function fulfilledAt(): DateTimeInterface;
}
