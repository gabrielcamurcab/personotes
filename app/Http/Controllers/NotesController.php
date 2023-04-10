<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotesCreateRequest;
use App\Http\Requests\NotesUpdateRequest;
use App\Http\Resources\NotesResource;
use App\Models\Notes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{

    public $notes;
    public function create(NotesCreateRequest $request) {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
        ],
        $messages = [
            'title.required' => 'Você precisa preencher o :attribute.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->validated();

        $note = Auth::user()->notes()->create($input);

        return redirect()->intended('notes');
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

        Notes::where('id', $input['id'])->update(
            [
                'title' => $input['title'],
                'text' => $input['text'],
            ]);

        return redirect()->intended('notes');
        //return new NotesResource($note->fresh());
    }

    public function updateview(Notes $note) {
        $notes = NotesResource::collection(Auth::user()->notes->where('id', $note->id));

        return view('notesupdate', ['notes' => $notes]);
    }

    public function delete(Notes $note) {
        $this->authorize('delete', $note);

        $note->delete();

        return redirect()->intended('notes');
    }
}
