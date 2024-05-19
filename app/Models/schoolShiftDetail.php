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
    public function SchoolShifts()
    {
        return $this->belongsTo(SchoolShifts::class, 'schoolShiftID');
    }

}
