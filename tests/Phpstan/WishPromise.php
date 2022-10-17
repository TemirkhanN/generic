<?php

declare(strict_types=1);

namespace Test\TemirkhanN\Generic\Phpstan;

use DateTimeInterface;

class WishPromise implements PromiseInterface
{
    public string $wishName;
    public \DateTime $willBeFulfilledAt;

    public function __construct(string $wishName, \DateTime $willBeFulfilledAt)
    {
        $this->wishName = $wishName;
        $this->willBeFulfilledAt = $willBeFulfilledAt;
    }

    public function name(): string
    {
        return $this->wishName;
    }

    public function fulfilledAt(): DateTimeInterface
    {
        return $this->willBeFulfilledAt;
    }
}
