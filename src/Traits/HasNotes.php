<?php

namespace Academe\Laravel\ContextualNotes\Traits;

/**
 *
 */

trait HasNotes
{
    public function notes()
    {
        return $this->morphToMany(
            'Academe\Laravel\ContextualNotes\Models\Note',
            'notable',
            config('academe-contextual-notes.notables.table', 'notables')
        );
    }
}
