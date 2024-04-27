<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function type(){
        return $this->belongsTo(RoomType::class, 'roomtype_id', 'id');
    }

    public function room_numbers(){
        return $this->hasMany(RoomNumber::class, 'rooms_id')->where('status','Active');
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class, 'rooms_id');
    }


    public function displayPrice()
    {
        return "Rp.".number_format($this->price, 2);
    }

    public function imageUrl()
    {
        if (!$this->image) {
            return url('upload/no_image.jpg');
        }
        return Storage::disk('public')->url('uploads/'.$this->image);
    }

}
