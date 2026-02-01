<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel convention)
    protected $table = 'applications';

    // Fillable fields
    protected $fillable = [
        'job_id',
        'user_id',
        'cover_letter',
        'resume',
        'status',
    ];

    /**
     * The job this application belongs to
     */
public function job()
{
    return $this->belongsTo(Job::class, 'job_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
