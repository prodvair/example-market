<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OfferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'search' => 'string',
            'max_price' => 'numeric',
            'sort_by' => [
                Rule::in([
                    'amount',
                    'products.created_at'
                ])
            ],
            'sort_type' => [
                Rule::in([
                    'desc',
                    'DESC',
                    'asc',
                    'ASC'
                ])
            ],
            'view' => [
                Rule::in([
                    'group',
                    'list'
                ])
            ]
        ];
    }
}
