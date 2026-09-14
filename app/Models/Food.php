<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'food',
        'price',
        'status',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
