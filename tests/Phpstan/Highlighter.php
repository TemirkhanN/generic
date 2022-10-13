<?php

declare(strict_types=1);

namespace Test\TemirkhanN\Generic\Phpstan;

class Highlighter
{
    public function grantFirstWish(): void
    {
        $service = new WishMaker();

        $result = $service->pleaseAddNativeGenerics();

        if ($result->isSuccessful()) {
            $fulfillmentDate = $result->getData()->willBeFulfilledAt;

            printf('OMG! Santa will add this at %s!', $fulfillmentDate->format('d-m-Y'));
        } else {
            print('Well, Santa can not do everything instead of you. Put some effort by yourself.');
        }
    }

    public function showSomeHappyStories(): void
    {
        $service = new WishMaker();

        $goodWishesThatWereFulfilled = $service->showMeSomeGoodWishes();

        foreach ($goodWishesThatWereFulfilled as $fulfilledWish) {
            printf(
                '%s was fulfilled on %s' . PHP_EOL,
                $fulfilledWish->wishName,
                $fulfilledWish->willBeFulfilledAt->format('d-m-Y')
            );
        }
    }
}
