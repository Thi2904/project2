<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class curriculums extends Model
{
    use HasFactory;
    protected $table = 'curriculum';
    protected $fillable = ['curriculumName','curriculumCode','curriculumVNName', 'majorID','note'];

    public function classes()
    {
        return $this->hasMany(Classes::class, 'curriculumID');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'majorID');
    }

    public function subjects()
    {
        return $this->hasMany(subjects::class, 'curriculumID');
    }

}
