<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (integer)$this->id,
            'title' => (string)$this->title,
            'text' => (string)$this->text,
            'color' => (string)$this->color,
            'background_color' => (string)$this->background_color,
            'created_at' =>(string)$this->created_at,
            'favorite' =>(integer)$this->favorite,
        ];
    }
}
