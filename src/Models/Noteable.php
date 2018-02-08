<?php

namespace Academe\Laravel\ContextualNotes\Models;

/**
 *
 */

use Illuminate\Database\Eloquent\Model;

class Notable extends Model
{
    public function getTable()
    {
        return config('academe-contextual-notes.notables.table', 'loggables');
    }
}
