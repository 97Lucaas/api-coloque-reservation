<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;
use App\Rules\EventNotFull;

class StoreInvitationRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => "L'email est déjà utilisé pour cet évènement",
            'event_id.exists' => "Cet évènement n'existe pas"
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => [
                'required', 
                'string', 
                'email', 
                Rule::unique('invitations')->where(
                    fn ($query) => $query->where('email', $this->email)->where('event_id', $this->event_id)
                )
            ],
            'event_id' => [
                'bail',
                'required', 
                'exists:App\Models\Event,id'
            ],
        ];
    }
}
