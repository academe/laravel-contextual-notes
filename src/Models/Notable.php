<?php

namespace Academe\Laravel\ContextualNotes\Models;

/**
 *
 */

use Illuminate\Database\Eloquent\Model;

class Notable extends Model
{
    // Needed to support microtime on MySQL.

    protected $dateFormat = 'Y-m-d H:i:s.u';

    public function getTable()
    {
        return config('academe-contextual-notes.notables.table', 'loggables');
    }
}
