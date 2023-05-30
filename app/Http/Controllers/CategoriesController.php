<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'user_id' => 'required|numeric'
            ],
            $messages = [
                'name.required' => 'Você precisa preeencher o nome da categoria.'
            ]
        );

        $input = $request->validated();

        $categorie = Auth::user()->categories()->create($input);
    }
}