<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // 🔽 This specifies the table name explicitly
    protected $table = 'students';

    // 🔽 This sets the custom primary key
    protected $primaryKey = 'student_id';

    // 🔽 These are the fields that can be mass-assigned
    protected $fillable = [
        'first_name',
        'last_name',
        'department',
        'email',
    ];
}
