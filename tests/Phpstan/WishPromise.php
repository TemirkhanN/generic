<?php

declare(strict_types=1);

namespace Test\TemirkhanN\Generic\Phpstan;

class WishPromise
{
    public string $wishName;
    public \DateTime $willBeFulfilledAt;

    public function __construct(string $wishName, \DateTime $willBeFulfilledAt)
    {
        $this->wishName = $wishName;
        $this->willBeFulfilledAt = $willBeFulfilledAt;
    }
}
