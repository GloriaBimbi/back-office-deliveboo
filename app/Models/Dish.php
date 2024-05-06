<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Dish extends Model
{
    public function orders()
    {
        return $this->BelongsToMany(Order::class)->withPivot('total_price');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function getImage()
    {
        if (!str_starts_with($this->image, 'https')) {
            return asset('storage/' . $this->image);
        } else {
            return $this->image;
        }
    }

    public function getAbstract($n_chars=30){
        return (strlen($this->description)>$n_chars)
        ? substr($this->description,0,$n_chars).'...'
        :$this->description;
    }

    protected $fillable = ['name', 'slug', 'price', 'ingredients_list', 'description', 'image'];
}
