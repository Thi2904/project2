<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schoolShiftDetail extends Model
{
    use HasFactory;
    protected $table = 'schoolShiftDetail';
    protected $fillable = [
        'schoolShiftID',
        'classroomID',
        'dateInWeek',
        'shiftsID',
    ];
    public function SchoolShift()
    {
        return $this->belongsTo(SchoolShifts::class, 'schoolShiftID');
    }

    public function subject()
    {
        return $this->belongsTo(subjects::class, 'subjectID');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classID');
    }
//    public function shift()
//    {
//        return $this->belongsTo(Shift::class, 'shiftsID');
//    }

}
