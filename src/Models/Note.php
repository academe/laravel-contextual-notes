<?php

namespace Academe\Laravel\ContextualNotes\Models;

/**
 * TODO: author
 * TODO: severity
 */

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'message',
    ];

    public function getTable()
    {
        return config('academe-contextual-notes.notes.table', 'notes');
    }

    /**
     * Add this note to a single model.
     *
     * @param Model $model any eloquent mndel
     * @return TBC
     */
    public function addToModel(Model $model)
    {
        return $this->morphedByMany(
            $model,
            'notable',
            config('academe-contextual-notes.notables.table', 'notables')
        )->save($model);
    }

    /**
     * Add this note to a list of models.
     * TODO: more flexibility of the types of lists that can be provided
     *
     * @param array $models eloquent mndels, of the same or different types
     * @return null
     */
    public function addToModels(array $models)
    {
        foreach ($models as $model) {
            $this->addToModel($model);
        }
    }

    public function __call($method, $arguments)
    {
        // Just trying this out.
        // The method name and model mapping would be set by configuration.
        // The same functionaility would be in the __get() magic method too.

        if ($method === 'bankTransactions') {
            return $this->morphedByMany(
                'Consilience\Bluejay\Ledger\Models\BankTransaction',
                'notable',
                config('academe-contextual-notes.notables.table', 'notables')
            );
        }

        return parent::__call($method, $arguments);
    }
}
