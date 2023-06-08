<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'unique:users|max:32',
            'email' => 'unique:users|max:254',
            'avatar' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Це ім\'я вже зайняте, спробуйте інше!',
            'name.max' => 'Довжина імені не повинна перевищувати 32 символи!',
            'email.unique' => 'Цей :attribute вже зайнятий, спробуйте іншу!',
            'email.max' => 'Адреса пошти не повинна перевищувати 255 символів!',
            'avatar.image' => 'Приймаються формати .png, .jpg і .jpeg!'
        ];
    }
}
