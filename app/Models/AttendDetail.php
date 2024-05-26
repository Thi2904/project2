<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendDetail extends Model
{
    use HasFactory;
    protected $table = 'attend_detail';
    protected $fillable = [
        'attendID',
        'studentID',
        'status',
        'reason'
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'attendID');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID');
    }
}
