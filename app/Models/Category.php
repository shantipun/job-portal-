<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon','image', 'status'];
   

    // Optional: relation to jobs
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
     public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
