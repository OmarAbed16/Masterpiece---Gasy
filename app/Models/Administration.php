<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'admin_id',
        'action_description',
        'action_time',
    ];

    protected $casts = [
        'is_deleted' => 'boolean',
        'action_time' => 'datetime',
    ];
}
