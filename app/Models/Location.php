<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{

    protected $fillable = [
        'name',
        'slug',
    ];

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($location) {
            $location->slug = Str::slug($location->name);
        });
    }

}
