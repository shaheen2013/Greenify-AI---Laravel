<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'site_name',
        'site_title',
        'contact_number',
        'email',
        'timezone',
        'date_format',
        'currency',
        'address',
        'map_location',
        'copyright',
        'light_logo',
        'dark_logo',
        'fav_icon',
    ];
}
