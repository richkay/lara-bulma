<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
{
    /**
     * User must have one `ADMIN_ROLES` or the `create-permissions` permission.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();

        return  $user->isAdmin() || $user->hasPermission('create-permissions');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:permissions'
        ];
    }
}
