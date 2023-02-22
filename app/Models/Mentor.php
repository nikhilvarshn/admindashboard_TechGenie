<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mentor extends Model
{
        use HasFactory, AuditableWithDeletesTrait, SoftDeletes;

        protected $table = 'mentors';
        protected $fillable = [
        'mtrid',
        'title',
        'email',
        'password',
        'category',
        'status',
        ];
}
