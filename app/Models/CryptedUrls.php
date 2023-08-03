<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptedUrls extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'user_url',
        'hashed_url',
        'expiration_date',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'expiration_date' => 'datetime'
    ];
}
