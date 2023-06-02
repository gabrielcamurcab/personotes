<?php

namespace App\Http\Controllers;

use App\Models\Categories;
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

        return view ('categoriescreate', ['message' => 'Categoria criada com sucesso']);
    }

    public function index() {
        $categories = Categories::where('user_id', Auth::user()->id)->get();

        //dd($categories);

        return view ('categoriescreate', ['categories' => $categories]);
    }
}