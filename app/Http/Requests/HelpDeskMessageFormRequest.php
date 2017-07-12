<?php

namespace Pmis\Http\Requests;

class HelpDeskMessageFormRequest extends Request
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'subject' => 'required',
                    'message' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'reply_message' => 'required',
                ];
            }
            default:break;
        }
    }
}
