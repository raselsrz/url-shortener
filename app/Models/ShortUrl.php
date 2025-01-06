<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'short_urls';

    // The attributes that are mass assignable.
    protected $fillable = [
        'title',
        'link',
        'shortLink',
        'user_id',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the ShortUrl.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
