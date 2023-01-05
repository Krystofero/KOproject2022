<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Offert extends Model
{
    use HasFactory;

    // protected $guarded = []; //wyłączam całą ochronę dla modelu

    protected $table = 'offerts';

   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'country',
        'description',
        'startdateturnus',
        'enddateturnus',
        'price',
        'user_id',
        'startdate',
        'enddate',
        'nights',
        'lastminute',
        'promotion',
        'promotionprice',
        'insuranceprice',
        'region',
        'city',
        'allinclusive',
        'allindescription',
        'placedescription',
        'pricedescription',
        'persnum',
        'hemail',
        'htel',
        'hoteldescription',
        'roomsdescription',
        'disdescription'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // //Offert = collection of images
    public function images()
    {
        return $this->hasMany('Image::class', 'offert_id');
    }

}