<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * User must have one `ADMIN_ROLES` or the `create-users` permission.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();

        return  $user->isAdmin() || $user->hasPermission('create-users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'email|max:50|nullable',
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'avatar' => 'image|nullable',
        ];
    }
}
