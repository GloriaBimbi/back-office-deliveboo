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
}
