<?php

namespace App\Modules\Links\Models;

use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GroupsUsers extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'groups_users', 'group_id', 'user_id');
    }
}
