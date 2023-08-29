<?php

namespace App\Modules\Links\Models;

use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    public $defaultRelations = [
        'user_id' => 'users',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'count'
    ];

    public function links(): BelongsToMany
    {
        return $this->belongsToMany(Link::class, 'link_groups', 'group_id', 'link_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_users', 'group_id', 'user_id')->withPivot(['user_id']);
    }
}
