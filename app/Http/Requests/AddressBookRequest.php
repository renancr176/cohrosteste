<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\AddressBook;

class AddressBookRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:191',
            'address' => 'max:191',
            'district' => 'max:191',
            'city' => 'max:191',
            'state' => 'max:2'
        ];
        if( !empty($this->request->get('email')) ){
            $rules['email'] = 'email|unique:address_books,email|max:191';
        }
        if( !empty($this->request->get('zip_code')) ){
            $rules['zip_code'] = 'min:9|max:9';
        }
        if( !empty($this->request->get('number')) ){
            $rules['number'] = 'numeric';
        }   
            
        return $rules;
    }
}
