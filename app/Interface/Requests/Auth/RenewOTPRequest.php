<?php
    
namespace App\Interface\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RenewOTPRequest extends FormRequest
{
    /**
     * Create a new class instance.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|int',
            'email'   => 'required|email',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 422,
                'message' => implode(', ', $validator->errors()->all()),
            ], 422)
        );
    }
}
