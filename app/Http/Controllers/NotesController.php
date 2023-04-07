<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotesCreateRequest;
use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function create(NotesCreateRequest $request) {
        $input = $request->validated();

        $note = auth()->user()->notes()->create($input);

        return $note;
    }
}
