<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Restaurant extends Model
{
    use HasFactory;

    // generate unique slug 
    public static function generateUniqueSlug($text, $ignore_id = null)
    {
      $base_slug = Str::slug($text);
  
      $slug_already_exists = Restaurant::where('slug', $base_slug)->where('id', '<>', $ignore_id)->count() ? true : false;
  
      if (!$slug_already_exists)
        return $base_slug;
  
      $counter = 1;
      do {
        $slug = $base_slug . '-' . $counter;
        $slug_already_exists = Restaurant::where('slug', $slug)->count() ? true : false;
  
        if (!$slug_already_exists)
          return $slug;
  
        $counter++;
      } while ($slug_already_exists);
    }

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
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    // fillable for data $request
    protected $fillable = ['description', 'name', 'piva', 'user->name'];

    public function getTypeText()
    {
        return $this->types->implode(',', $this->types->pluck('name')->toArray());
    }
    public function getImage()
    {
        if (!str_starts_with($this->image, 'https')) {
            return asset('storage/' . $this->image);
        } else {
            return $this->image;
        }
    }

    // Metodo per trasformare l'indirizzo in camel case
    public static function camelCase($word)
    {
        return ucwords($word);
    }

    // Metodo per trasformare l'indirizzo in camel case
    public static function upperCase($word)
    {
        return strtoupper($word);
    }

    // transform id restaurant in url
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
