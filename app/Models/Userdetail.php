<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userdetail extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'mobile_no',
        'coll_name',
        'course_name',
        'dob',
        'gender',
        'plan_id',
        'purchase_date',
        'expire_date',
        'plan_status'
    ];
}
