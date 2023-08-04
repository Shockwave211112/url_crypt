<?php

namespace App\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmLinks extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'token',
        'expiry_date'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'expiry_date' => 'datetime'
    ];
}
