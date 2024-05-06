<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    // relationship many to many 
    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    // relationship one to one 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relationship one to many 
    public function dishes(){
        return $this->hasMany(Dish::class);
    }

    // fillable for data $request
    protected $fillable=['description','name','piva', 'user->name'];

    public function getTypeText(){
        return $this->types->implode(',',$this->types->pluck('name')->toArray());
    }
    public function getImage(){
        if(!str_starts_with($this->image,'https')) {
            return asset('storage/' . $this->image);

        } else {
            return $this->image;

        }
    }
}
