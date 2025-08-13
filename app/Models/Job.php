<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'salary',
        'location',
        'employment_type',
        'featured',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function applicants()
    {
        return $this->belongsToMany(User::class, 'user_job_application', 'job_id', 'user_id');
    }
}
