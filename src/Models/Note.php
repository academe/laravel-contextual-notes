<?php

namespace Academe\Laravel\ContextualNotes\Models;

/**
 * TODO: author
 * TODO: severity/level
 */

use Illuminate\Database\Eloquent\Model;
use Log;

class Note extends Model
{
    protected $fillable = [
        'level',
        'message',
    ];

    protected $attributes = [
        'message' => '',
    ];

    public function getTable()
    {
        return config('academe-contextual-notes.notes.table', 'notes');
    }

    /**
     * Relationship.
     */
    public function models($model)
    {
        return $this->morphedByMany(
            $model instanceof Model ? get_class($model) : $model,
            'notable',
            config('academe-contextual-notes.notables.table', 'notables')
        );
    }

    /**
     * Add this note to a single model.
     *
     * @param Model $model any eloquent mndel
     * @return TBC
     */
    public function attachModel(Model $model)
    {
        return $this->models($model)->save($model);
    }

    /**
     * Add this note to a list of models.
     * TODO: more flexibility of the types of lists that can be provided, or
     * even support varidiac (?) parameters.
     *
     * @param array $models eloquent mndels, of the same or different types
     * @return self
     */
    public function attach($models)
    {
        if (! is_array($models) && ! $models instanceof \Traversable) {
            $models = [$models];
        }

        foreach ($models as $model) {
            if ($model instanceof Model) {
                $this->attachModel($model);
            }
        }

        return $this;
    }

    /**
     * Reverse relationship, defined by config.
     */
    public function __call($method, $arguments)
    {
        $mapping = config('academe-contextual-notes.models', []);

        if (array_key_exists($method, $mapping)) {
            return $this->morphedByMany(
                $mapping[$method],
                'notable',
                config('academe-contextual-notes.notables.table', 'notables')
            );
        }

        return parent::__call($method, $arguments);
    }

    /**
     * Write a log entry for this note, to the default log.
     */
    public function withLog()
    {
    }
}
