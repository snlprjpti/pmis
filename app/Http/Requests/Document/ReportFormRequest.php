<?php

namespace Pmis\Http\Requests\Document;

use Pmis\Http\Requests\Request;

class ReportFormRequest extends Request
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

        return array_merge($rules, ['book_file' => 'mimes:jpeg,jpg,png,pdf,doc,docx']);
    }

    public function storeRules()
    {
        return [
            'fiscal_id' => 'required',
            'title' => 'required',
            'office_id' => 'required',
            'type' => 'required',
            'book_file' => 'mimes:jpeg,jpg,png,pdf,doc,docx',
        ];
    }
}
