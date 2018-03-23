<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['display_name', 'description'];
}
