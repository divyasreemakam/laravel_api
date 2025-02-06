<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.customerId' => ['required', 'integer'],
            '*.status' => ['required', Rule::in(['P','B','V','p','b','v'])],
            '*.amount' => ['required', 'integer'],
            '*.paidDate' => ['date_format:Y-m-d H:i:s', 'nullable'],
            '*.billedDate' => ['required','date_format:Y-m-d H:i:s'],
        ];
    }

    protected function prepareForValidation() {
       $data = [];

       foreach($this->toArray() as $obj) {
            $obj['customer_id'] = $obj['customerId']?? null;
            $obj['paid_date'] = $obj['paidDate']?? null;
            $obj['billed_date'] = $obj['billedDate']?? null;

            $data[] = $obj;
       }

       $this->merge($data);
    }
}
