<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyRequest extends Model
{
    protected $table = 'admin_requests';

    protected $fillable = [
        'user_id',
        'comp_name',
        'location',
        'logo',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
