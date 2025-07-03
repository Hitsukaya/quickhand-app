<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'location_id',
        'title',
        'slug',
        'short_description',
        'full_description',
        'people_needed',
        'reward',
        'job_duration_minutes',
        'expires_at',
        'phone_number',
        'is_resolved',
        'posted_at',
    ];

    protected $casts = [
    'expires_at' => 'datetime',
    'posted_at' => 'datetime',
    'is_resolved' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(AdApplication::class);
    }

    public function getIsExpiredAttribute()
    {
        return now()->greaterThan($this->expires_at);
    }

    public function getIsActiveAttribute()
    {
        return !$this->is_resolved && !$this->is_expired;
    }

    public function applicationsCount()
    {
        return $this->applications()->count();
    }

    public function isFull()
    {
        return $this->applications()->count() >= $this->people_needed;
    }
}
