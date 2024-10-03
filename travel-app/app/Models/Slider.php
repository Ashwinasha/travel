<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    use HasFactory; // Include this if you're using Laravel 8+ and working with factories

    // Specify the table if it doesn't follow Laravel's naming convention
    protected $table = 'sliders';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'image_path',
        'slider',
        'button_name',
        'nav_link',
    ];
}

