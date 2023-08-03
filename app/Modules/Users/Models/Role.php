<?php

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;

    public const UNVERIFIED_USER = 'Unverified';
    public const USER = 'User';
    public const ADMIN = 'Admin';


    /**
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];
}
