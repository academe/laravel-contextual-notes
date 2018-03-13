<?php

namespace Academe\Laravel\ContextualNotes;

/**
 *
 */

use Academe\Laravel\ContextualNotes\Models\Note;

class Service
{
    public function createLevel($level, $message, array $context = [])
    {
        $note = new Note([
            'level' => $level,
            'message' => $message,
        ]);

        $note->save();

        if (! empty($context)) {
            $note->attach($context);
        }

        return $note;
    }

    public function emergency($message, array $context = [])
    {
        return $this->createLevel('emergency', $message, $context);
    }

    public function alert($message, array $context = [])
    {
        return $this->createLevel('alert', $message, $context);
    }

    public function critical($message, array $context = [])
    {
        return $this->createLevel('critical', $message, $context);
    }

    public function error($message, array $context = [])
    {
        return $this->createLevel('error', $message, $context);
    }

    public function warning($message, array $context = [])
    {
        return $this->createLevel('warning', $message, $context);
    }

    public function notice($message, array $context = [])
    {
        return $this->createLevel('notice', $message, $context);
    }

    public function info($message, array $context = [])
    {
        return $this->createLevel('info', $message, $context);
    }

    public function debug($message, array $context = [])
    {
        return $this->createLevel('debug', $message, $context);
    }
}
