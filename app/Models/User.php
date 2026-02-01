<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable; // remove HasApiTokens if not needed

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'profile_image',
      
        'location',
      
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'skills' => 'array', // if you store JSON
    ];
    public function applications()
{
    return $this->hasMany(Application::class); // Assuming your applications table is linked via user_id
}
public function savedJobs()
{
    return $this->hasMany(SavedJob::class);
}
// User.php
public function jobs() {
    return $this->hasMany(Job::class, 'employer_id');
}

}
