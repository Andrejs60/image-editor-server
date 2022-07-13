<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ["user_id", "image_path"];

    protected $fillable = ["user_id", "name", "image_path"];

    // User relationship (Image has one User)
    public function user() {
        return $this->belongsTo("App\User");
    }
}
