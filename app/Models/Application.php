<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public function application_photos()
    {
        return $this->morphMany('App\Models\ApplicationPhoto', 'application_photos');
    }
}
