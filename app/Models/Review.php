<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tour;
use App\Models\User;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'user_id',
        'rating',
        'comment',
    ];
    public function tour() {
        return $this->belongsTo(Tour::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
