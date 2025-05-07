// app/Http/Requests/TagRequest.php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tag = $this->route('tag');
        $tagId = $tag ? $tag->id : null;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags')->ignore($tagId),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'نام',
        ];
    }
}
