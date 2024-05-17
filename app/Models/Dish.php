<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Dish extends Model
{
    // SoftDeletes facade for soft-deletes
    use HasFactory, SoftDeletes;

    // generate unique slug 
    public static function generateUniqueSlug($text, $ignore_id = null)
  {
    $base_slug = Str::slug($text);

    $slug_already_exists = Dish::where('slug', $base_slug)->where('id', '<>', $ignore_id)->count() ? true : false;

    if (!$slug_already_exists)
      return $base_slug;

    $counter = 1;
    do {
      $slug = $base_slug . '-' . $counter;
      $slug_already_exists = Dish::where('slug', $slug)->count() ? true : false;

      if (!$slug_already_exists)
        return $slug;

      $counter++;
    } while ($slug_already_exists);
  }
    public function orders()
    {
        return $this->BelongsToMany(Order::class)->withPivot('quantity');
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

    public function getAbstract($n_chars = 30)
    {
        return (strlen($this->description) > $n_chars)
            ? substr($this->description, 0, $n_chars) . '...'
            : $this->description;
    }

    protected $fillable = ['name', 'slug', 'price', 'ingredients_list', 'description', 'image'];


    // transform id dish in url
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
