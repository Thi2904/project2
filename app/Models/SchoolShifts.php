<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolShifts extends Model
{
    use HasFactory;
    protected $table = 'schoolShift';
    protected $fillable = [
        'dateStart',
        'classID',
        'subjectID',
        'teacherID',
    ];
    public function schoolShiftDetails()
    {
        return $this->hasMany(SchoolShiftDetail::class, 'schoolShiftID');
    }
    public function class()
    {
        return $this->belongsTo(Classes::class, 'classID');
    }
    public function subject()
    {
        return $this->belongsTo(subjects::class, 'subjectID');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'teacherID');
    }
}
