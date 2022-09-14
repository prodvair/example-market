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
            'max_price' => 'float',
            'sortBy' => [
                Rule::in([
                    'amount',
                    'products.created_at'
                ])
            ],
            'sortType' => [
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
