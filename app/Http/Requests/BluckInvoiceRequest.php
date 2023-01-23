<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BluckInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            '*.customerId' => ['required'],
            '*.amount' =>  ['required' ],
            '*.status' => ['required' , Rule::in(['B','b','P','p','V','v'])],
            '*.billedDate' => ['required','date_format:Y-m-d H:i:s'],
            '*.paidDate' => ['date_format:Y-m-d H-i-s','nullable'],
        ];
    }
    
    protected function prepareForValidation()
    {
        $data=[];
        foreach($this->toArray() as $obj){
            $obj['customer_id']=$obj['customerId'] ?? null;
            $obj['billed_date']=$obj['billedDate'] ?? null;
            $obj['paid_date']=$obj['paidDate'] ?? null;
            $data[]=$obj;
        }
        $this->merge($data);
    }
}
