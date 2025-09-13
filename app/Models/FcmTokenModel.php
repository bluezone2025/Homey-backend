<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use function PHPUnit\Framework\isNull;

class FcmTokenModel extends Model
{
    protected $table="fcm_tokens";
    protected $fillable = [
      "id" ,"user_id","token" 
    ];

}
