<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ["title", "description", "thumbnail", "release_date", "genre"];

}
