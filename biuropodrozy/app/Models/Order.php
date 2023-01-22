<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'offert_id',
        'price',
        'firstname',
        'lastname',
        'email',
        'tel',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function offert()
    {
        return $this->belongsTo('App\Offert');
    }
}
