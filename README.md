# generic
Basic generic classes/interfaces for php

## Why?

While we are waiting for a native generics support it is a good idea to try the concept on.  

## How?

Personally I'm tired of checked exception usage, and thus it lead me to command result usage.  

## Result

```php
<?php

declare(strict_types=1);

use TemirkhanN\Generic\Collection\Collection;
use TemirkhanN\Generic\Collection\CollectionInterface;
use TemirkhanN\Generic\Result;
use TemirkhanN\Generic\ResultInterface;

// Just a data structure. Don't pay much attention here
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

class WishMaker
{
    /**
     * This one is actually not truly honest: error means that there is no data.
     * Still, it is fully valid - attempt to get it will end up with exception.  
     * Result should always be checked for `isSuccessful` state. 
     *
     * @return ResultInterface<WishPromise>
     */
    public function pleaseAddNativeGenerics(): ResultInterface
    {
        return Result::error(
            Error::create('We have much more important things to do. Named parameters, breaking Liskov and stuff.')
        );
    }
}

class Highlighter
{
    public function grantFirstWish(): void
    {
        $service = new WishMaker();

        $result = $service->pleaseAddNativeGenerics();

        if ($result->isSuccessful()) {
            // This is it. The data is generic yet PHPStorm and PHPStan know what particular type it is
            $fulfillmentDate = $result->getData()->willBeFulfilledAt;

            printf('OMG! Santa will add this at %s!', $fulfillmentDate->format('d-m-Y'));
        } else {
            print('Well, Santa can not do everything instead of you. Put some effort by yourself.');
        }
    }
}
```

### Collection

This one is pretty common nowadays. It is just a simple generic collection.  
> It DOES NOT perform validations and type checks. Just because there is no convenient way to do that 
> without meta-programming and burdening the interface.


```php

// Just a data structure. Don't pay much attention here
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


class WishMaker
{
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


class Highlighter
{
    public function showSomeHappyStories(): void
    {
        $service = new WishMaker();

        $goodWishesThatWereFulfilled = $service->showMeSomeGoodWishes();

        // Both PHPStorm and PHPStan know that items are WishPromise instances
        // No need for inline manual highlighting on each call
        foreach ($goodWishesThatWereFulfilled as $fulfilledWish) {
            printf(
                '%s was fulfilled on %s' . PHP_EOL,
                $fulfilledWish->wishName,
                $fulfilledWish->willBeFulfilledAt->format('d-m-Y')
            );
        }
    }
}
```

## Known issues

`ResultInterface` by design can not detect type in case of error for there is no type passed.  

It means, that after `Result::error(...)` there is no data type declared and thus getData() is considered mixed. 

```php
<?php

class WishMaker
{
    /**
     * @return ResultInterface<WishPromise>
     */
    public function pleaseAddNativeGenerics(): ResultInterface
    {
        // Generic can not determine the data type, so it will not match ResultInterface<WishPromise>
        return Result::error(Error::create('Nope'));
    }
}

```

If you use PHPStan lvl9+ you can add this particular error to ignore  
```yaml
# phpstan.neon.dist
parameters:
  ignoreErrors:
    - '#should return TemirkhanN\\Generic\\ResultInterface<.+?> but returns TemirkhanN\\Generic\\Result<mixed>#'
```

or include rules directly

```yaml
# phpstan.neon.dist
includes:
  - vendor/temirkhann/generic/extension.neon
```
