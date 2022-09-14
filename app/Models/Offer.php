<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'product_id',
        'amount',
        'count'
    ];

    public function sellers(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
