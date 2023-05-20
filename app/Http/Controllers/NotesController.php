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
use GrahamCampbell\Markdown\Facades\Markdown;
use League\HTMLToMarkdown\HtmlConverter;

$converter = new HtmlConverter();

class NotesController extends Controller
{
    public $notes;
    public function create(NotesCreateRequest $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'title' => ['required', 'string'],
                'text' => ['required', 'string'],
            ],
            $messages = [
                'title.required' => 'Você precisa preencher o :attribute.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->validated();

        //$input['text'] = Markdown::convert($input['text'])->getContent();

        $note = Auth::user()->notes()->create($input);

        return redirect()->intended('notes');
    }

    public function index()
    {
        //$notes = NotesResource::collection(Auth::user()->notes);

        $notes = Notes::where('user_id', Auth::user()->id)->orderBy('favorite', 'DESC')->orderBy('created_at', 'DESC')->get();

        //dd($notes);

        for ($i = 0; $i < count($notes); $i++) {
            $notes[$i]['text'] = Markdown::convert($notes[$i]['text'])->getContent();
        }

        return view('notes', ['notes' => $notes]);
    }

    public function show(Notes $note)
    {
        $this->authorize('show', $note);

        return new NotesResource($note);
    }

    public function update(NotesUpdateRequest $request)
    {
        //$this->authorize('update', $note);

        $input = $request->validated();

        //$input['text'] = Markdown::convert($input['text'])->getContent();

        Notes::where('id', $input['id'])->update(
            [
                'title' => $input['title'],
                'text' => $input['text'],
                'color' => $input['color'],
                'background_color' => $input['background_color'],
            ]
        );

        return redirect()->intended('notes');
        //return new NotesResource($note->fresh());
    }

    public function updateview(Notes $note)
    {
        $converter = new HtmlConverter();

        //$notes = Auth::user()->notes->where('id', $note->id);
        $notes = Notes::where([['user_id', '=', Auth::id()], ['id', '=', $note->id]])->get();

        //$notes[0]->text = $converter->convert($notes[0]->text);

        return view('notesupdate', ['notes' => $notes]);
    }

    public function delete(Notes $note)
    {
        $this->authorize('delete', $note);

        $note->delete();

        return redirect()->intended('notes');
    }

    public function addFavorite(Notes $note)
    {
        $note->update(['favorite' => 1]);
    }

    public function removeFavorite(Notes $note)
    {
        $note->update(['favorite' => 0]);
    }
}