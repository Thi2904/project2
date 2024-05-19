<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subjects extends Model
{
    use HasFactory;
    protected $fillable = [
        'subjectName',
        'codeName',
        'majorID',
        'curriculumID',
        'description',
        'subjectTime'
    ];
    public function major()
    {
        return $this->belongsTo(major::class, 'majorID');
    }

    public function curriculum()
    {
        return $this->belongsTo(curriculums::class, 'curriculumID');
    }

    public function SchoolShifts()
    {
        return $this->hasMany(SchoolShifts::class, 'subjectID');
    }
}
