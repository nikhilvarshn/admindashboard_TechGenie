<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registered extends Model
{
    use HasFactory, AuditableWithDeletesTrait, SoftDeletes;

    protected $table = 'registers';
    protected $fillable = [
        'full_name',
        'email',
        // 'status',
    ];
}
