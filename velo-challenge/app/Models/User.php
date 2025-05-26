<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'password_hash', 'gender', 'birth_date', 'role'];

    public function challengesCreated()
    {
        return $this->hasMany(Challenge::class, 'created_by');
    }

    public function challengesParticipated()
    {
        return $this->belongsToMany(Challenge::class, 'challenge_participants', 'user_id', 'challenge_id')
                    ->withPivot('joined_at')
                    ->withTimestamps();
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
