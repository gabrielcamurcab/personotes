<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
public $categories;

    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string'
            ],
            $messages = [
                'name.required' => 'Você precisa preeencher o nome da categoria.'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request;

        $categorie = Auth::user()->categories()->create([
            'name' => $input->name,
        ]);

        $categories = Categories::where('user_id', Auth::user()->id)->get();

        return view ('categoriescreate', ['categories' => $categories], ['message' => 'Categoria criada com sucesso']);
    }

    public function index() {
        $categories = Categories::where('user_id', Auth::user()->id)->get();

        //dd($categories);

        return view ('categoriescreate', ['categories' => $categories]);
    }

    public function delete(Categories $categorie) {
        $this->authorize('delete', $categorie);

        Notes::where('categorie_id', $categorie->id)->update(['categorie_id' => null]);
        
        $categorie->delete();
        
        return redirect()->intended('categories');
    }

    public function updateview(Categories $categorie) {
        $this->authorize('update', $categorie);

        $categories = Categories::where('id', $categorie->id)->get();

        //dd($categories);

        return view('categoriesupdate', ['categories' => $categories]);
    }

    public function update(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string'
            ],
            $messages = [
                'name.required' => 'Você precisa preeencher o nome da categoria.'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request;

        Categories::where('id', $input['id'])->update(
            ['name' => $input['name']]
        );

        $categories = Categories::where('user_id', Auth::user()->id)->get();

        return view ('categoriescreate', ['categories' => $categories], ['message' => 'Categoria atualizada com sucesso']);
    }
}