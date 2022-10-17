<?php

declare(strict_types=1);

namespace TemirkhanN\Generic;

use TemirkhanN\Generic\Exception\RuntimeException;

/**
 * @template TDetails of array<mixed>
 */
final class Error implements ErrorInterface
{
    private string $message;
    private int $code;
    /** @var array<mixed> */
    private array $details;

    /**
     * @param string $message
     * @param int $code
     * @param TDetails $details
     */
    private function __construct(string $message, int $code = 0, array $details = [])
    {
        $this->message = $message;
        $this->code    = $code;
        $this->details = $details;
    }

    /**
     * @template D of array<mixed>
     *
     * @param string $message
     * @param int $code
     * @param D $details
     *
     * @return static<D>
     */
    public static function create(string $message, int $code = 0, array $details = []): self
    {
        if ($message === '') {
            throw new RuntimeException('Error shall contain at least some message');
        }

        return new self($message, $code, $details);
    }

    /**
     * @return static<array{}>
     */
    public static function none(): self
    {
        static $none;

        if ($none === null) {
            $none = new self('');
        }

        return $none;
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
     * @return TDetails
     */
    public function getDetails(): array
    {
        return $this->details;
    }
}
