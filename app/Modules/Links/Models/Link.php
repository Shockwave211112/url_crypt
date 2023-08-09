<?php

namespace App\Modules\Links\Models;

use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Link extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'origin',
        'referral',
    ];

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'link_group', 'link_id', 'group_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'link_user', 'link_id', 'user_id');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasAccess(User $user): bool
    {
        return $this->users->first()->pivot->user_id === $user->id;
    }
}
