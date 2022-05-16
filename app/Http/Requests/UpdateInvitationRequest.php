<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UpdateInvitationRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => [
                'required', 
                'string', 
                'email', 
                Rule::unique('invitations')->where(
                    fn ($query) => $query->where('email', $this->email)->where('event_id', $this->event_id)
                )->ignore('id')
            ],
            'is_scanned' => ['boolean']
        ];
    }
}
