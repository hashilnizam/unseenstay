<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    public function room_types()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
