<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    // To make laravel parse it as Date object
    protected $dates = ['birthday'];

    protected $fillable = ['name', 'phone','birthday','address','email','company', 'image_url','user_id'];

}
