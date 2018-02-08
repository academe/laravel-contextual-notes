<?php

namespace Academe\Laravel\ContextualNotes;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return ServiceProvider::PROVIDES;
    }
}
