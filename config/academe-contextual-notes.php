<?php

/**
 * academe-contextual-notes
 */

return [
    'notes' => [
        'table' => 'contextual_notes',
    ],
    'notables' => [
        'table' => 'contextual_notables',
    ],

    /**
     * Array of relationship names and classes for the relationship from
     * a note to a model.
     * With the example below configured, this will give you a collection of
     * users that are attached to a note (usually zero or one):
     *
     * $note->users;
     */
    'models' => [
        'users' => App\User::class,
    ],
];
