<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, AuditableWithDeletesTrait, SoftDeletes;

    protected $table = 'students';
    protected $fillable = [
        'stdid',
        'studentname',
        'fathername',
        'mothername',
        'dob',
        'age',
        'gender',
        'bloodgroup',
        'permanentaddress',
        'city',
        'state',
        'pincode',
        'religion',
        'mobilenumber',
        'status',
    ];
}
