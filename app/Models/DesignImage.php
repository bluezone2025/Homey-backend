<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class DesignImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function  design(){

        return $this->belongsTo( Design::class);
    }



}
