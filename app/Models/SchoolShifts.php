<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolShifts extends Model
{
    use HasFactory;
    protected $fillable = [
        'dateStart',
        'classID',
        'subjectID',
        'teacherID',
    ];
}
