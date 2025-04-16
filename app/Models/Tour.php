<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'start_date',
        'end_date',
        'location',
    ];
    public function images()
    {
        return $this->hasMany(\App\Models\TourImage::class);
    }

}
