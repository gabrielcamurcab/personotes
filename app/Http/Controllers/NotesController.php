<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotesCreateRequest;
use App\Http\Requests\NotesUpdateRequest;
use App\Http\Resources\NotesResource;
use App\Models\Notes;
use App\Models\User;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function create(NotesCreateRequest $request) {
        $input = $request->validated();

        $note = auth()->user()->notes()->create($input);

        return $note;
    }

    public function index() {
        return NotesResource::collection(auth()->user()->notes);
    }

    public function show(Notes $note) {
        return new NotesResource($note);
    }

    public function update(Notes $note, NotesUpdateRequest $request) {
        $input = $request->validated();

        $note->fill($input);
        $note->save();

        return new NotesResource($note->fresh());
    }
}
