<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getStatusAttribute()
    {
        return $this->attributes['status'] == 1 ? 'Active' : 'Disabled';
    }
    
}
