<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [ "user_id","title", "description", "thumbnail", "release_date", "genre"];

    public function user()
{
    return $this->belongsTo(User::class);
}

}
