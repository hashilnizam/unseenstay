<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Property extends Model
{
    use HasFactory;

    public function property_types()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }
    public function rooms()
    {
        return $this->hasMany(Room::class, 'property_id');
    }

}
