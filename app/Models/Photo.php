<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['album_id', 'image_url', 'image_key', 'caption', 'order'];
    protected $casts = ['order' => 'integer'];
    
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
