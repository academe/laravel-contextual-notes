<?php

namespace Academe\Laravel\ContextualNotes\Models;

/**
 * TODO: author
 * TODO: severity/level
 */

use Illuminate\Database\Eloquent\Model;
use Traversable;
use Log;

class Note extends Model
{
    // Needed to support microtime on MySQL.

    protected $dateFormat = 'Y-m-d H:i:s.u';

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
     * @return bool
     */
    public function attachModel(Model $model)
    {
        return $this->models($model)->save($model);
    }

    /**
     * Add this note to a list of models.
     *
     * @param array|Traversable $models eloquent mndels, of the same or different types
     * @return self
     */
    public function attach($models)
    {
        if (! is_array($models) && ! $models instanceof Traversable) {
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
     * TODO: Write a log entry for this note, to the default log.
     */
    public function withLog()
    {
    }
}
