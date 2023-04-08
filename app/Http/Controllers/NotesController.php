<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotesCreateRequest;
use App\Http\Requests\NotesUpdateRequest;
use App\Http\Resources\NotesResource;
use App\Models\Notes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{

    public $notes;
    public function create(NotesCreateRequest $request) {
        $input = $request->validated();

        $note = Auth::user()->notes()->create($input);

        return view('notes');
    }

    public function index() {
        $notes = NotesResource::collection(Auth::user()->notes);

        return view('notes', ['notes' => $notes]);
    }

    public function show(Notes $note) {
        $this->authorize('show', $note);

        return new NotesResource($note);
    }

    public function update(Notes $note, NotesUpdateRequest $request) {
        $this->authorize('update', $note);

        $input = $request->validated();

        $note->fill($input);
        $note->save();

        return new NotesResource($note->fresh());
    }

    public function delete(Notes $note) {
        $this->authorize('delete', $note);

        $note->delete();
    }
}
