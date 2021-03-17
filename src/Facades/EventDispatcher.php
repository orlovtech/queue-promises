<?php

namespace Tochka\Promises\Facades;

use Illuminate\Support\Facades\Facade;
use Tochka\Promises\Contracts\PromisedEvent;

/**
 * @method static dispatch(PromisedEvent $event)
 * @see \Tochka\Promises\Core\Support\EventDispatcher
 */
class EventDispatcher extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return self::class;
    }
}
