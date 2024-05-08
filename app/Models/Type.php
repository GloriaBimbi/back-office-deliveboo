<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }

    public function getImage(){
        if(!str_starts_with($this->logo,'https')) {
            return asset('storage/' . $this->logo);

        } else {
            return $this->image;

        }
    }
}
