<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tour;

class Booking extends Model
{
use HasFactory;

    protected $fillable = ['tour_id', 'user_id', 'name', 'email', 'adults', 'children', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


public function tour()
{
return $this->belongsTo(Tour::class);
}
}
