<?php

namespace App\Modules\Links\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Groups extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description'
    ];

    public function links(): BelongsToMany
    {
        return $this->belongsToMany(Links::class);
    }
}
