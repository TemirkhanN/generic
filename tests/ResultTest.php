<?php

declare(strict_types=1);

namespace Test\TemirkhanN\Generic;

use PHPUnit\Framework\TestCase;
use TemirkhanN\Generic\Result;

class ResultTest extends TestCase
{
    public function testError(): void
    {
        $result = Result::error('Some error message');

        self::assertFalse($result->isSuccessful());
        self::assertEquals('Some error message', $result->getError());

        self::expectException(\RuntimeException::class);
        $result->getData();
    }

    public function testSuccess(): void
    {
        $result = Result::success(['Some data']);

        self::assertTrue($result->isSuccessful());
        self::assertEmpty($result->getError());
        self::assertEquals(['Some data'], $result->getData());
    }
}
