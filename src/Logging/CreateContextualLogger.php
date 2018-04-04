<?php

namespace Academe\Laravel\ContextualNotes\Logging;

use Monolog\Logger;

class CreateContextualLogger
{
    public function __invoke(array $config)
    {
        return new Logger(...);
    }
}
