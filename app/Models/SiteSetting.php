<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteSetting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function imageUrl()
    {
        if (!$this->logo) {
            return url('upload/no_image.jpg');
        }
        return Storage::disk('public')->url('uploads/'.$this->logo);
    }
}
