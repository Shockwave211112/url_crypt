<?php

namespace App\Modules\Links\Models;

use App\Modules\Links\Factories\LinkFactory;
use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Link extends Model
{
    use HasFactory;

    public $defaultRelations = [
        'group_id' => 'groups',
        'user_id' => 'users',
    ];

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
        return $this->belongsToMany(Group::class, 'link_groups', 'link_id', 'group_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'link_users', 'link_id', 'user_id')->withPivot(['user_id']);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasAccess(User $user): bool
    {
        return in_array($user->id, $this->users->pluck('id')->toArray());
    }

    /**
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return LinkFactory::new();
    }
}
