<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'responsibilities',
        'requirements',
        'employer_id',
        'company_id',
        'category_id',
        'company_name',
        'company_website',
        'location',
        'salary',
        'job_type',
        'last_date',
       'is_active' => 'boolean',
    ];

    // Relationship: Job belongs to an employer (User)
    public function employer() {
        return $this->belongsTo(User::class, 'employer_id');
    }
 public function applications()
{
    return $this->hasMany(Application::class, 'job_id');
}
public function savedByUsers()
{
    return $this->hasMany(SavedJob::class);
}
public function category()
{
    return $this->belongsTo(Category::class);
}


public function company()
{
    return $this->belongsTo(Company::class);
}
}
