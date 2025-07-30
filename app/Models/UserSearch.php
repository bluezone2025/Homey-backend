<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSearch extends Model
{
    protected $table="user_search";
    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'text'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
