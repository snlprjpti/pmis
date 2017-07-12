<?php

namespace Pmis\Http\Requests\Configuration;

use Pmis\Http\Requests\Request;

class CensusFormRequest extends Request
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
            'total_population' => 'required',
            'birth_per_sec' => 'required',
            'death_per_sec' => 'required',
            'migration_per_sec' => 'required',
            'sex_ratio' => 'required',
            'census_year' => 'required',
        ];
    }
}
