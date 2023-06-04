<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotesCreateRequest;
use App\Http\Requests\NotesUpdateRequest;
use App\Http\Resources\NotesResource;
use App\Models\Categories;
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

    public function createview()
    {
        $categories = Categories::where('user_id', Auth::user()->id)->get();

        return view('notescreate', ['categories' => $categories]);
    }
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

        //$input['categorie_id'] = intval($input['categorie_id']);

        //dd($input);

        $note = Auth::user()->notes()->create($input);

        return redirect()->intended('notes');
    }

    public function index()
    {
        $notes = Notes::where('notes.user_id', Auth::user()->id)->orderBy('favorite', 'DESC')->orderBy('created_at', 'DESC')->leftJoin('categories', 'notes.categorie_id', '=', 'categories.id')->select('notes.*', 'categories.name as categorieName')->get();

        for ($i = 0; $i < count($notes); $i++) {
            $notes[$i]['text'] = Markdown::convert($notes[$i]['text'])->getContent();
        }

        $categories = Categories::where('user_id', Auth::user()->id)->get();

        return view('notes', ['notes' => $notes, 'categories' => $categories]);
    }

    public function indexByCategorie(Categories $categorieid)
    {
        $notes = Notes::where('notes.user_id', Auth::user()->id)->where('categorie_id', $categorieid->id)->orderBy('favorite', 'DESC')->orderBy('created_at', 'DESC')->leftJoin('categories', 'notes.categorie_id', '=', 'categories.id')->select('notes.*', 'categories.name as categorieName')->get();

        for ($i = 0; $i < count($notes); $i++) {
            $notes[$i]['text'] = Markdown::convert($notes[$i]['text'])->getContent();
        }

        $categories = Categories::where('user_id', Auth::user()->id)->get();

        return view('notes', ['notes' => $notes, 'categories' => $categories]);
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
                'categorie_id' => $input['categorie_id'],
            ]
        );

        return redirect()->intended('notes');
        //return new NotesResource($note->fresh());
    }

    public function updateview(Notes $note)
    {
        $converter = new HtmlConverter();

        //$notes = Auth::user()->notes->where('id', $note->id);
        $notes = Notes::where([['notes.user_id', '=', Auth::id()], ['notes.id', '=', $note->id]])->leftJoin('categories', 'notes.categorie_id', '=', 'categories.id')->select('notes.*', 'categories.name as categorieName')->get();

        $categories = Categories::where('user_id', Auth::user()->id)->get();

        //$notes[0]->text = $converter->convert($notes[0]->text);

        return view('notesupdate', [
            'notes' => $notes,
            'categories' => $categories,
        ]);
    }

    public function delete(Notes $note)
    {
        $this->authorize('delete', $note);

        $note->delete();

        return redirect()->intended('notes');
    }

    public function favorite(Notes $note)
    {
        $this->authorize('favorite', $note);

        Notes::where('id', $note->id)->update(['favorite' => 1]);

        return redirect()->intended('notes');
    }

    public function unfavorite(Notes $note)
    {
        $this->authorize('unfavorite', $note);

        Notes::where('id', $note->id)->update(['favorite' => 0]);

        return redirect()->intended('notes');

    }
}