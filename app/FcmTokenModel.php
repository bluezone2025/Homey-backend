<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FcmTokenModel extends Model
{
    use HasFactory;
    protected $table="fcm_tokens";
    protected $fillable = [
        "id" ,"user_id","token"
    ];
}
