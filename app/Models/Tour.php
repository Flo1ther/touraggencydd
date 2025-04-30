<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\City;
use App\Models\Tag;
use App\Models\TourImage;
use App\Models\Booking;

class Tour extends Model
{

    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'start_date',
        'end_date',
        'duration_days',
        'adults',
        'children',
        'location',
        'country_id',
        'city_id',
        'hotel',
        'category_id',
        'transport',
        'rating',
        'services',
        'is_hot',
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function images()
    {
        return $this->hasMany(\App\Models\TourImage::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_tour');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

}
