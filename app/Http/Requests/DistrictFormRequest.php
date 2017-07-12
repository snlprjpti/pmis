<?php

namespace Pmis\Http\Requests;

class DistrictFormRequest extends Request
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

        return array_merge($rules, ['map_file' => 'mimes:jpeg,jpg,png', 'district_document' => 'mimes:jpeg,jpg,png,doc,docx,pdf']);
    }

    private function storeRules()
    {
        return [
            'name' => 'required',
            'zone_id' => 'required',
            'headquarter' => 'required',
            'map_file' => 'required|mimes:jpeg,jpg,png',
            'district_document' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
        ];
    }
}
