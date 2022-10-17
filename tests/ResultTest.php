<?php

declare(strict_types=1);

namespace Test\TemirkhanN\Generic;

use PHPUnit\Framework\TestCase;
use TemirkhanN\Generic\Error;
use TemirkhanN\Generic\Result;

class ResultTest extends TestCase
{
    public function testError(): void
    {
        $result = Result::error(Error::create('Some error message', 23, ['some' => 'details', 1 => 'here']));

        self::assertFalse($result->isSuccessful());

        $error = $result->getError();
        self::assertEquals('Some error message', $error->getMessage());
        self::assertEquals(23, $error->getCode());
        self::assertEquals(['some' => 'details', 1 => 'here'], $error->getDetails());

        self::expectException(\RuntimeException::class);
        $result->getData();
    }

    public function testSuccess(): void
    {
        $result = Result::success(['Some data']);

        self::assertTrue($result->isSuccessful());
        self::assertEquals(['Some data'], $result->getData());
    }
}
