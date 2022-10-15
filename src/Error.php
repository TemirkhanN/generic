<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

class Error
{
    private string $message;
    private int $code;
    /** @var array<mixed> */
    private array $details;

    /**
     * @param string $message
     * @param int $code
     * @param array<mixed> $details
     */
    public function __construct(string $message, int $code = 0, array $details = [])
    {
        $this->message = $message;
        $this->code    = $code;
        $this->details = $details;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return array<mixed>
     */
    public function getDetails(): array
    {
        return $this->details;
    }
}
