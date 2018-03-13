<?php

namespace Academe\Laravel\ContextualNotes\Traits;

/**
 *
 */

use Academe\Laravel\ContextualNotes\Models\Note;

trait HasNotes
{
    public function contextualNotes()
    {
        return $this->morphToMany(
            Note::class,
            'notable',
            config('academe-contextual-notes.notables.table', 'notables')
        );
    }
}
