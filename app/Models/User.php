<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Request;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    public function isUser(): bool
    {
        return $this->role === 'user';
    }
    public function isCompany(): bool
    {
        return $this->role === 'company';
    }

    public function employer()
    {
        return $this->hasOne(Employer::class);
    }

    public function jobs()
    {
        return $this->hasManyThrough(Job::class, Employer::class);
    }
    public function applications()
    {
        return $this->belongsToMany(Job::class, 'user_job_application', 'user_id', 'job_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function requests()
    {
        return $this->belongsToMany(Request::class);
    }
}
