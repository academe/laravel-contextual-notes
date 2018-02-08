<?php

namespace Academe\Laravel\ContextualNotes\Models;

/**
 *
 */

use Illuminate\Database\Eloquent\Model;

use Consilience\Bluejay\Ledger\Models\BankTransaction;

class Note extends Model
{
    public function getTable()
    {
        return config('academe-contextual-notes.notes.table', 'notes');
    }

    public function bankTransactions()
    {
        return $this->morphedByMany(
            //\Illuminate\Database\Eloquent\Model::class,
            BankTransaction::class,
            //null,
            'notable',
            config('academe-contextual-notes.notables.table', 'notables')
        );
    }
}
