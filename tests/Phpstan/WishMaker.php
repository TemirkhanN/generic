<?php

declare(strict_types=1);

namespace Test\TemirkhanN\Generic\Phpstan;

use TemirkhanN\Generic\Collection\Collection;
use TemirkhanN\Generic\Collection\CollectionInterface;
use TemirkhanN\Generic\Result;
use TemirkhanN\Generic\ResultInterface;

class WishMaker
{
    /**
     * @return ResultInterface<WishPromise>
     */
    public function pleaseAddNativeGenerics(): ResultInterface
    {
        return Result::error(
            'We have much more important things to do. Named parameters, breaking Liskov and stuff.'
        );
    }

    /**
     * @return CollectionInterface<WishPromise>
     */
    public function showMeSomeGoodWishes(): CollectionInterface
    {
        return new Collection([
            new WishPromise('Make PHP mature and awesome', new \DateTime('03 December 2015')),
            new WishPromise('Please, we need typed properties', new \DateTime('28 November 2019')),
            new WishPromise('Enums are essential. We need them', new \DateTime('25 November 2021')),
        ]);
    }
}
