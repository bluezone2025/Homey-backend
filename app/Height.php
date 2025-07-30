<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Height extends Model
{
    protected $table = 'heights';
    protected $fillable = [
       'name'
    ];
    protected $guarded=[];
}
