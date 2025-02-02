<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WheelSlider extends Model
{
    use HasFactory;
    
    protected $fillable = ['photos_path', 'title', 'description'];

}
