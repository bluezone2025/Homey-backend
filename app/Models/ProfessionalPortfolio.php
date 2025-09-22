<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalPortfolio extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Professional()
    {
        return $this->belongsTo(Professional::class , 'professional_id' , 'id');
    }
}
