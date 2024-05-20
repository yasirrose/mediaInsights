<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $table = 'my_podcasts'; // specify the table name

    protected $fillable = [
        'name',
        'description',
        'image_url',
    ];


    //Define relationship with episodes
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
