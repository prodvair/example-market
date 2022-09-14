<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Seller extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    protected $hidden = [
        'token',
    ];

    public function offers(): BelongsTo {
        return $this->hasMany(Offer::class, 'seller_id', 'id');
    }
}
