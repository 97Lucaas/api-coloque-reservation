<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>['required', 'string'],
            'description'=>['required', 'string'],
            'place'=>'string',
            'end_participation_date'=>'date',
            'start_date'=>'date',
            'max_invitations_enabled'=>'required_with:max_invitations',
            'max_invitations'=>'required_with:max_invitations_enabled',
            'slug'=>['required', 'string', Rule::unique('events', 'slug')]
        ];
    }
}
