<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use function PHPUnit\Framework\isNull;

class ShowNotification extends Model
{
    protected $table="show_notifications";
    protected $fillable = [
      "id" ,'user_id','notification_id'
    ];


}
