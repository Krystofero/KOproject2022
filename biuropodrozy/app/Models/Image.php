<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $fillable = [
        'offert_id',
        'url',
        'is_main'
    ];
    public function offert()
    {
        return $this->belongsTo('Offert:class', 'offert_id');
    }
}
