<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'imageUrl',
        'audioUrl',
    ];



    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
}
