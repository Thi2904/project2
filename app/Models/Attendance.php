<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendance';
    protected $fillable = [
        'schoolShiftID',
        'date'
    ];

    public function schoolShift()
    {
        return $this->belongsTo(SchoolShifts::class, 'schoolShiftID');
    }

    public function attendDetails()
    {
        return $this->hasMany(AttendDetail::class, 'attendID');
    }
}
