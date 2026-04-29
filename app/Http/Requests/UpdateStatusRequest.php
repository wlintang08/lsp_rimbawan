<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'superadmin'], true);
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:diterima,ditolak,lulus,tidak_lulus',
        ];
    }
}
