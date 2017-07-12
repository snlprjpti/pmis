<?php

namespace Pmis\Http\Requests;

class UserFormRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        $rules = $this->storeRules();
        if ($this->method() == 'POST') {
            return $rules;
        }

        unset($rules['password']);

        return $rules;
    }

    private function storeRules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'district_id' => 'required',
            'office_id' => 'required',
            'designation_id' => 'required',
            'type' => 'required',
            'password' => 'required',
        ];
    }
}
