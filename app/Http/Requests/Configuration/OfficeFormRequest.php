<?php

namespace Pmis\Http\Requests\Configuration;

use Pmis\Http\Requests\Request;

class OfficeFormRequest extends Request
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
        return [
            'office_name' => 'required',
            'district_id' => 'required',
        ];
    }
}
