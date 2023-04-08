<?php

namespace App\Exceptions;

use Exception;

class UserHasBeenTakenException extends Exception
{
    protected $message = 'User exists.';

    public function render() {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage()
        ], 400);
    }
}
